<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170731_092950_create_building_table extends Migration
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
