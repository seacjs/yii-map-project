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

    /*
     *
     *  online shema generator
     *  http://dbdesigner.net/designer/schema/112001
     *
     * */
    public function up()
    {

        /**
         * MAP REGION CITY BUILDING
         */

        $this->createTable('prototype_map', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'active' => $this->smallInteger(),
            'author_id' => $this->integer(),
        ]);
        $this->createTable('prototype_region', [
            'id' => $this->primaryKey(),
            'map_id' => $this->integer(),
            'name' => $this->string()->notNull(),
            'centerX' => $this->float(),
            'centerY' => $this->float(),
            'path' => $this->text(),
            'landscape' => $this->integer(),
        ]);
        $this->createTable('prototype_road', [
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
        $this->createTable('prototype_resource', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->string(),
        ]);
        $this->createTable('prototype_product', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'description' => $this->string(),
        ]);

        /**
         * BUILDINGS
         */

        /* Здания */
        $this->createTable('prototype_building', [
            'id' => $this->integer(),
            'name' => $this->string(),
            'max_level' => $this->integer(),
            'levels_names' => $this->string(2048),
            'author_id' => $this->integer(),
        ]);
        /* Какие здания нужны для постройит этого здания и какого уровня */
        $this->createTable('prototype_building_require_building', [
            'id' => $this->integer(),
            'prototype_building_id' => $this->integer(),
            'require_building_id' => $this->integer(),
            'require_building_level' => $this->integer(),
        ]);

        /* Какие продукты нужны для постройки этого здания */
        $this->createTable('prototype_building_require_product', [
            'id' => $this->integer(),
            'prototype_building_id' => $this->integer(),
            'require_product_id' => $this->integer(),
            'count' => $this->integer(),
        ]);
        /* Что здание производит и в каком количестве */
        $this->createTable('prototype_building_production', [
            'id' => $this->integer(),
            'prototype_building_id' => $this->integer(),
            'product_id' => $this->integer(),
            'count' => $this->integer(),
        ]);
        /* Что здание потребляет и в каком количестве */
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
        $this->dropTable('prototype_building_production');
        $this->dropTable('prototype_building_consumption');
    }
}
