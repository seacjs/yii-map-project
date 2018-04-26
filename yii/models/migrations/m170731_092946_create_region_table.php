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

            'user_id' => $this->integer()->defaultValue(null),
//            'house_id' => $this->integer()->defaultValue(null),

            /* levels */
//            'epidemic',

            'centerX' => $this->float(),
            'centerY' => $this->float(),
            'path' => $this->text(),
            'landscape' => $this->integer(),
        ]);
        $this->addForeignKey('fk-region-user_id','region', 'user_id', 'user', 'id', 'RESTRICT', 'RESTRICT');

        $this->createTable('road', [
            'id' => $this->primaryKey(),
            'from_region_id' => $this->integer(),
            'to_region_id' => $this->integer(),
            'quality_level' => $this->integer(),
            'pointX' => $this->float(),
            'pointY' => $this->float(),
        ]);

        $this->addForeignKey('fk-road-from_region_id','road', 'from_region_id', 'region', 'id','CASCADE','CASCADE');
        $this->addForeignKey('fk-road-to_region_id','road', 'to_region_id', 'region', 'id', 'CASCADE','CASCADE');

        $regions = json_decode(file_get_contents('http://yii-strategy-project/js/svg.json'), true);
        foreach($regions as $key => $region) {
            $this->insert('region', [
                'name' => $key,
                'path' => $region,
            ]);
        }

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
