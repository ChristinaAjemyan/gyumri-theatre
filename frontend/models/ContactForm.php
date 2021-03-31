<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $phone;
    public $body;
    public $subject;
//    public $verifyCode;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'phone', 'body'], 'required','message' => Yii::t('home','Դաշտը դատարկ է')],
//            [['name', 'email', 'phone', 'body', 'verifyCode'], 'required','message' => Yii::t('home','Դաշտը դատարկ է')],
            // email has to be a valid email address
            [['subject'],'safe'],
            ['email', 'email', 'message' => Yii::t('home','Սխալ Էլ-հասցե')],
            // verifyCode needs to be entered correctly
//            ['verifyCode', 'captcha', 'message' => Yii::t('home','Սխալ սիմվոլներ')],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('home', 'Անուն Ազգանուն'),
            'email' => Yii::t('home', 'Էլ-հասցե'),
            'phone' => Yii::t('home', 'Հեռախոսահամար'),
            'body' => Yii::t('home', 'Հաղորդագրություն'),
//            'verifyCode' => Yii::t('home', 'Ստուգման ծածկագիր')
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo('gyumrytheatre@gmail.com')
            ->setFrom($this->email)
            ->setReplyTo([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setHtmlBody("<p>Name: $this->name</p><p>Content: $this->body</p>"."<p>Mail: $this->email</p>"."<p>Phone: $this->phone</p>")
            ->send();
    }
}
