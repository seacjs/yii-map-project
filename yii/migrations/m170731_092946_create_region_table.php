<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170731_092946_create_region_table extends Migration
{

    /**
     * @inheritdoc
     */

    public function up()
    {

        /**
         *  REGION CITY BUILDING
         */
        $this->createTable('region', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'house_id' => $this->integer()->defaultValue(null),

            /* levels */
//            'epidemic',

            'centerX' => $this->float(),
            'centerY' => $this->float(),
            'path' => $this->text(),
            'landscape' => $this->integer(),
        ]);
        $this->addForeignKey('fk-region-user_id','region', 'house_id', 'house', 'id', 'RESTRICT', 'RESTRICT');

        $this->createTable('road', [
            'id' => $this->primaryKey(),
            'from_region_id' => $this->integer(),
            'to_region_id' => $this->integer(),
            'quality_level' => $this->integer(),
            'pointX' => $this->float(),
            'pointY' => $this->float(),
        ]);

        $this->addForeignKey('fk-road-from_region_id', 'road', 'from_region_id', 'region', 'id','CASCADE','CASCADE');
        $this->addForeignKey('fk-road-to_region_id', 'road', 'to_region_id', 'region', 'id', 'CASCADE','CASCADE');

        $this->createTable('village', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'population' => $this->integer(),
            'region_id' => $this->integer(),

            'brewer' => $this->integer()->defaultValue(0),
            'blacksmith' => $this->integer()->defaultValue(0),
            'fisherman' => $this->integer()->defaultValue(0),
            'farmer' => $this->integer()->defaultValue(0),
            'breeder' => $this->integer()->defaultValue(0),
            'groom' => $this->integer()->defaultValue(0),
            'hunter' => $this->integer()->defaultValue(0),
            'peasant' => $this->integer()->defaultValue(0),
        ]);
        $this->addForeignKey('fk-village-region_id', 'village', 'region_id', 'region','id', 'CASCADE', 'CASCADE');

        /* add regions */
        //$regions = json_decode(file_get_contents('http://yii-strategy-project/js/svg.json'), true);
//        foreach($regions as $key => $region) {
//            $this->insert('region', [
//                'name' => $key,
//                'path' => $region,
//            ]);
//        }

        $irelandRegions = [
            'Kerry',
            'Antrim',
            'Londonderry',
            'Down',
            'Armagh',
            'Louth',
            'Tyrone',
            'Wexford',
            'Dublin',
            'Wicklow',
            'Monaghan',
            'Donegal',
            'Fermanagh',
            'Waterford',
            'Cork',
            'Limerick',
            'Clare',
            'Carlow',
            'Kilkenny',
            'Laois',
            'Tipperary',
            'Meath',
            'Kildare',
            'Cavan',
            'Leitrim',
            'Sligo',
            'Roscommon',
            'Galway',
            'Longford',
            'Westmeath',
            'Offaly',
            'Mayo'
        ];
        foreach($irelandRegions as $region) {
            $this->insert('region',[
                'name' => $region,
            ]);
            $regionId = Yii::$app->db->getLastInsertID();
            for($n = 0; $n <= rand(1,3); $n++) {
                $population = rand(10,20);
                $village = new \app\models\Village();
                $village->region_id = $regionId;
                $village->name = 'noName';
                $village->population = $population;
                for($i = 1; $i <= $population; $i++) {
                    $profesion = \app\models\Village::randomProfession(rand(1,100));
                    $village[$profesion] = $village[$profesion] + 1;
                }
                $village->save();

            }
        }

        $roads = [
            [], // #0
            [15,16],
            [3,4],
            [2,7,12],
            [5,2],
            [4,6,7,11], // #5
            [5,9,11,22],
            [3,5,11,12,13],
            [10,18,19],
            [10,22,23],
            [8,9,18,23], // #10
            [5,6,7,13,24],
            [3,7,13,25],
            [7,11,12,24,25],
            [15,19,21],
            [1,14,16], // #15
            [1,15,17,21],
            [16,21,28],
            [8,10,19,20,23],
            [8,14,18,20,21],
            [18,19,21,23,31], // #20
            [14,15,16,17,19,20,28,31],
            [6,9,23,24,30,31],
            [9,10,18,20,22,31],
            [11,13,22,25,29,30],
            [12,13,24,26,27,29], // #25
            [25,27,32],
            [25,26,28,29,30,31,32],
            [17,21,27,31,32],
            [24,25,27,30],
            [22,24,27,29,31], // #30
            [20,21,22,23,27,28,30],
            [26,27,28]
        ];
        foreach($roads as $key => $provinceRoads) {
            foreach($provinceRoads as $road) {
                $this->insert('road', [
                    'from_region_id' => $key,
                    'to_region_id' => $road,
                    'quality_level' => 3,
                ]);
            }
        }



        /* add roads */
//        $regionsRoads = json_decode(file_get_contents('http://yii-strategy-project/js/roads.json'), true);
//        foreach($regionsRoads as $key => $roads) {
//            foreach($regions as $region) {
//                $this->insert('road', [
//                    'from_region_id' => $key+1,
//                    'to_region_id' => $region,
//                    'quality_level' => 1,
//                ]);
//            }
//        }

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('region');
        $this->dropTable('road');
    }
}
