<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "road".
 *
 * @property integer $id
 * @property integer $from_region_id
 * @property integer $to_region_id
 * @property integer $quality_level
 * @property double $pointX
 * @property double $pointY
 *
 * @property Region $toRegion
 * @property Region $fromRegion
 */
class Road extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'road';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['from_region_id', 'to_region_id', 'quality_level'], 'integer'],
            [['pointX', 'pointY'], 'number'],
            [['to_region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['to_region_id' => 'id']],
            [['from_region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['from_region_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'from_region_id' => Yii::t('app', 'From Region ID'),
            'to_region_id' => Yii::t('app', 'To Region ID'),
            'quality_level' => Yii::t('app', 'Quality Level'),
            'pointX' => Yii::t('app', 'Point X'),
            'pointY' => Yii::t('app', 'Point Y'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getToRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'to_region_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFromRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'from_region_id']);
    }
}
