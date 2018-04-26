<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170731_092948_create_region_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('region', [
            'id' => $this->primaryKey(),
            'world_id' => $this->integer(),
            'prototype_id' => $this->integer(),

            'user_id' => $this->integer(),
            'house_id' => $this->integer(),

            /* levels */
            'epidemic'
            /* плодородие процветание порядок наука санитария*/


        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('region');
    }
}
