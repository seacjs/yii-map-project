<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170731_092949_create_city_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('world', [
            'id' => $this->primaryKey(),
            'world_id' => $this->integer(),
            'map_id' => $this->interger(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('world');
    }
}
