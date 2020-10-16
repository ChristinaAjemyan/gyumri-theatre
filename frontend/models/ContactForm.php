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
    public $subject;
    public $body;
    public $verifyCode;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body', 'verifyCode'], 'required','message' => Yii::t('home','Դաշտը դատարկ է')],
            // email has to be a valid email address
            ['email', 'email', 'message' => Yii::t('home','Սխալ Էլ-հասցե')],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha', 'message' => Yii::t('home','Սխալ սիմվոլներ')],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('home', 'Անուն'),
            'email' => 'E-mail',
            'subject' => Yii::t('home', 'Թեմա'),
            'body' => Yii::t('home', 'Հաղորդագրություն'),
            'verifyCode' => Yii::t('home', 'Ստուգման ծածկագիր')
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
            ->setTo($email)
            ->setFrom($this->email)
            ->setReplyTo([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setHtmlBody("<span>$this->body</span><br>"."<p>$this->email</p>")
            ->send();
    }
}
