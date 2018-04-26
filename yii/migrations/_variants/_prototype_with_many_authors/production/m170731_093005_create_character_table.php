<?php

use yii\db\Migration;

/**
 * Handles the creation of table `character`.
 */
class m170731_093005_create_character_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('character', [
            'id' => $this->primaryKey(),
            'world_id' => $this->integer()->notNull(), // игровой мир
            'owner_id' => $this->integer(), // кто управляет этим персонажем(null значит никто)
            'house_id' => $this->integer(), // Дом семья

            'culture' => $this->integer(),// культура сейчас
            'religion' => $this->integer(),// титул сейчас

            /* титулы */
            'title_origin' => $this->integer(),// титул по происхождению
            'title' => $this->integer(),// титул сейчас

            /* харрактеристики */

            'diplomacy' => $this->integer()->notNull(),
            'management' => $this->integer()->notNull(),
            'trade' => $this->integer()->notNull(),
            'combat' => $this->integer()->notNull(),
            'espionage' => $this->integer()->notNull(),

        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('character');
    }
}
