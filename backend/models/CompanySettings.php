<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "company_settings".
 *
 * @property int $id
 * @property int $company_id
 * @property int $phone
 * @property string $email
 * @property string $address
 * @property string $country
 * @property string $city
 * @property string $zip
 *
 * @property Companies $company
 */
class CompanySettings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'company_settings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'phone', 'email', 'address', 'country', 'city', 'zip'], 'required'],
            [['company_id', 'phone'], 'integer'],
            [['address'], 'string'],
            [['email', 'country', 'city', 'zip'], 'string', 'max' => 255],
            [['company_id'], 'exist', 'skipOnError' => true, 'targetClass' => Companies::className(), 'targetAttribute' => ['company_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'company_id' => Yii::t('app', 'Company ID'),
            'phone' => Yii::t('app', 'Phone'),
            'email' => Yii::t('app', 'Email'),
            'address' => Yii::t('app', 'Address'),
            'country' => Yii::t('app', 'Country'),
            'city' => Yii::t('app', 'City'),
            'zip' => Yii::t('app', 'Zip'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(Companies::className(), ['id' => 'company_id']);
    }
}
