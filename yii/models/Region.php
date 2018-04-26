<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property integer $id
 * @property string $name
 * @property integer $user_id
 * @property double $centerX
 * @property double $centerY
 * @property string $path
 * @property integer $landscape
 *
 * @property Population[] $populations
 * @property User $user
 * @property Road[] $roads
 * @property Road[] $roads0
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['user_id', 'landscape'], 'integer'],
            [['centerX', 'centerY'], 'number'],
//            [['path'], 'string'],
            [['name'], 'string', 'max' => 255],
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
            'name' => Yii::t('app', 'Name'),
            'user_id' => Yii::t('app', 'User ID'),
            'centerX' => Yii::t('app', 'Center X'),
            'centerY' => Yii::t('app', 'Center Y'),
            'path' => Yii::t('app', 'Path'),
            'landscape' => Yii::t('app', 'Landscape'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPopulations()
    {
        return $this->hasMany(Population::className(), ['region_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoadsTo()
    {
        return $this->hasMany(Road::className(), ['to_region_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoadsFrom()
    {
        return $this->hasMany(Road::className(), ['from_region_id' => 'id']);
    }
    public function getVillages()
    {
        return $this->hasMany(Village::className(), ['region_id' => 'id']);
    }
}
