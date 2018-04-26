<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170731_092945_create_prototype_map_table extends Migration
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

            'user_id' => $this->integer(),
            'house_id' => $this->integer(),

            /* levels */
            'epidemic',

            'centerX' => $this->float(),
            'centerY' => $this->float(),
            'path' => $this->text(),
            'landscape' => $this->integer(),
        ]);
        $this->createTable('road', [
            'id' => $this->primaryKey(),
            'from_region_id' => $this->integer(),
            'to_region_id' => $this->integer(),
            'quality_level' => $this->integer(),
            'pointX' => $this->float(),
            'pointY' => $this->float(),
        ]);

        /**
         * RESOURCE PRODUCT
         * resources on the map
         * product in the warehouse
         */
        $this->createTable('product', [
            'id' => $this->primaryKey(),
        ]);

        /**
         * BUILDINGS
         */
        $this->createTable('prototype_building', [
            'id' => $this->integer(),
            'name' => $this->string(),
            'max_level' => $this->integer(),
            'levels_names' => $this->string(2048),
            'author_id' => $this->integer(),
        ]);
        $this->createTable('prototype_building_require_building', [
            'id' => $this->integer(),
            'prototype_building_id' => $this->integer(),
            'require_building_id' => $this->integer(),
            'require_building_level' => $this->integer(),
        ]);
        $this->createTable('prototype_building_require_product', [
            'id' => $this->integer(),
            'prototype_building_id' => $this->integer(),
            'require_product_id' => $this->integer(),
            'count' => $this->integer(),
        ]);
        $this->createTable('prototype_building_production', [
            'id' => $this->integer(),
            'prototype_building_id' => $this->integer(),
            'product_id' => $this->integer(),
            'count' => $this->integer(),
        ]);
        $this->createTable('prototype_building_consumption', [
            'id' => $this->integer(),
            'prototype_building_id' => $this->integer(),
            'product_id' => $this->integer(),
            'count' => $this->integer(),
        ]);




        /**
         * CULTURE RELIGION EPIDEMIC
         */
/* todo:: landscapes */

//        $this->createTable('prototype_epidemic', [
//            'id' => $this->primaryKey(),
//        ]);
//        $this->createTable('prototype_culture', [
//            'id' => $this->primaryKey(),
//        ]);
//        $this->createTable('prototype_religion', [
//            'id' => $this->primaryKey(),
//        ]);

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('prototype_map');
        $this->dropTable('prototype_region');
        $this->dropTable('prototype_road');

        $this->dropTable('prototype_resource');
        $this->dropTable('prototype_product');

        $this->dropTable('prototype_building');
        $this->dropTable('prototype_building_require_building');
        $this->dropTable('prototype_building_require_resource');
        $this->dropTable('user');
        $this->dropTable('user');
        $this->dropTable('user');
    }
}
