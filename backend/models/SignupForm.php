<?php
namespace backend\models;

use backend\models\Companies;
use common\models\Languages;
use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $first_name;
    public $last_name;
    public $company_name;
    public $language;
    public $phone;
    public $email;
    public $password;
    public $password_repeat;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['first_name', 'trim'],
            ['first_name', 'required'],
            ['phone', 'required'],
            ['first_name', 'string', 'min' => 2, 'max' => 255],
            ['company_name', 'required'],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],
            ['password_repeat', 'required'],
            ['password_repeat', 'compare', 'compareAttribute'=>'password', 'message'=>"Passwords don't match" ],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $lang = Languages::getCurrent();
        $user->lang = $lang->url;
        $user->phone = $this->phone;
        //var_dump(Languages::getCurrent());die;
        $user->email = $this->email;
        $user->status = $user::STATUS_ACTIVE;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        if($user->save()){
            $ObjCompany = new Companies();
            $ObjCompany->name= $this->company_name;
            $ObjCompany->type= 'new';
            $ObjCompany->created_at= date('Y-m-d H:s:i');
            if($ObjCompany->save()){
                $companySettings = new CompanySettings();
                $companySettings->phone = $user->phone;
                $companySettings->email = $user->email;
                $companySettings->company_id = $ObjCompany->id;
                $companySettings->save();
                $user->company_id = $ObjCompany->id;

                $user->save();
            }
        }
        return $this->sendEmail($user);

    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => Yii::t('label', 'Email'),
            'first_name' => Yii::t('label', 'First Name'),
            'last_name' => Yii::t('label', 'Last Name'),
            'phone' => Yii::t('label', 'Phone Number'),
            'company_name' => Yii::t('label', 'Company Name'),
            'language' => Yii::t('label', 'Language'),
            'password' => Yii::t('label', 'Password'),
            'password_repeat' => Yii::t('label', 'Repeat password '),

        ];
    }
    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
