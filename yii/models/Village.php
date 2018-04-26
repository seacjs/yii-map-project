<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "village".
 *
 * @property integer $id
 * @property string $name
 * @property integer $population
 * @property integer $region_id
 *
 * @property Region $region
 */
class Village extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'village';
    }

    const DEFAULT_MONTH = 0;
    const COLD_MONTH = 1;
    const GRATE_MONTH = 2;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['population', 'region_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => Region::className(), 'targetAttribute' => ['region_id' => 'id']],
        ];
    }

    /*
     * Вероятность появления профессии dв деревне
     * */
    public static function randomProfession($randomInt)
    {

        $randoms = [
            'peasant' => 41,
            'farmer' => 16,
            'hunter' => 9,
            'fisherman' => 9,
            'breeder' => 8,
            'brewer' => 7,
            'blacksmith' => 7,
            'groom' => 3,
        ];
        $procent = 0;
        foreach($randoms as $key => $item) {
            $procent += $item;
            if($randomInt <= $procent) {
                return $key;
            }
        }

    }

    public static function getProfessionArray() {
        return [
            'peasant',
            'farmer',
            'hunter',
            'fisherman',
            'breeder',
            'brewer',
            'blacksmith',
            'groom',
        ];
    }
    public function getProduction()
    {
        return [
            'brewer' => [
                'beer' => [2,1,2],
            ],
            'blacksmith' => [
                'weapons' => [2,1,2],
                'armor' => [2,1,2],
                'instruments' => [2,1,2],
            ],
            'fisherman' => [
                'fish' => [1,1,1],
            ],
            'farmer' => [
                'grain' => [0,0,5],
                'fruits' => [0,0,2],
            ],
            'breeder' => [
                'meat' => [1,0,1],
            ],
            'groom' => [
                'horse' => [1,0,1],
                'warhorse' => [1,0,1]
            ],
            'hunter' => [
                'fur' => [2,1,2], // мех
                'leather' => [2,1,2], // кожа
                'meat' => [2,1,2],
            ],
        ];
    }
    public function getConsumption()
    {
        return [];
    }

    /*
     * ТОРГОВЛЯ
     * - берется весь избыток продуктов в общий пул (или несколько торговых центров)
     * - расчитывается торговый_уровень деревни
     * - в зависимости от торгового_уровня ведется продажа и покупка всех товаров с общим пулом orderBy('trade_level')
     * */

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'population' => Yii::t('app', 'Population'),
            'region_id' => Yii::t('app', 'Region ID'),

            /* levels */

            'epidemic_level' => Yii::t('app','Epidemic Level'),
            'happiness_level' => Yii::t('app','Happiness Level'),
            /* ... */

            /* population */

            'brewer' => Yii::t('app','пивовар'),
            'blacksmith' => Yii::t('app','кузнец'),
            'fisherman' => Yii::t('app','рыбак'),
            'farmer' => Yii::t('app','фермер'),
            'breeder' => Yii::t('app','животновод'),
            'groom' => Yii::t('app','конюх'),
            'hunter' => Yii::t('app','охотник'),

            'peasant' => Yii::t('app','крестьянин'),


            /*
            Профессии для замка:
            рудокоп
            камнетес
            лесоруб
            шахтер
            столяр

            Професси для деревни:

            пивовар - пиво из зерна
            пекарь(мельник) - хлеб из зерна
            кузнец - инструменты и оружие, броню из руды
            кожевник - кожаные броня и одежда

            рыбак - производит рыбу
            крестьянин - производит зерно и сено
            животновод - производит из животных мясо, и разводит новых животных
            конюх - боевых коней, и обычных
            охотник - производит мясо, шкуры и кожу

            бездельник - можно нанять
             * */
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Region::className(), ['id' => 'region_id']);
    }

    /**
     * @inheritdoc
     * @return VillageQuery the active query used by this AR class.
     */
//    public static function find()
//    {
//        return new VillageQuery(get_called_class());
//    }
}
