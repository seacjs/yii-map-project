<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170731_092947_create_world_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('world', [
            'id' => $this->primaryKey(),
            'map_id' => $this->interger(),
            'name' => $this->string()->notNull(),
            'description' => $this->string()->notNull(),
            'active' => $this->smallInteger(),
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
