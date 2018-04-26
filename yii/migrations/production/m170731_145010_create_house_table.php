<?php

use yii\db\Migration;

/**
 * Handles the creation of table `house`.
 */
class m170731_145010_create_house_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('house', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'world_id' => $this->integer(),

            'name' => $this->string(64),
            'description' =>$this->string(255),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('house');
    }
}
