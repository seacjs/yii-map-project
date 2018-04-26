<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "house".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $money
 * @property integer $honor
 * @property string $name
 * @property string $banner
 *
 * @property User $user
 */
class House extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'house';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'money', 'honor'], 'integer'],
            [['name', 'banner'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'money' => Yii::t('app', 'Money'),
            'honor' => Yii::t('app', 'Honor'),
            'name' => Yii::t('app', 'Name'),
            'banner' => Yii::t('app', 'Banner'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
