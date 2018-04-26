<?php

use yii\db\Migration;

/**
 * Handles the creation of table `house`.
 */
class m170731_145012_create_soldier_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('soldier_prototype', [
            'id' => $this->primaryKey(),
            'world_id' => $this->integer(),
            'author_id' => $this->integer(),

            'culture' =>$this->integer(),
            'religion' =>$this->integer(),
            'caste' => $this->integer(),

            'level' => $this->integer(),
        ]);

        $this->createTable('soldier', [
            'id' => $this->primaryKey(),
            'world_id' => $this->integer(),

            'soldier_prototype_id' => $this->integer(),
            'squad_id' => $this->integer(),

            'culture' => $this->integer(),
            'religion' => $this->integer(),
            'caste' => $this->integer(),

            'weapon_id' => $this->integer(),
            'armour_id' => $this->integer(),
            'shield_id' => $this->integer(),
            'horse_id' => $this->integer(),

            'level' => $this->integer(),

            'health' => $this->integer(), // Здороьве
            'усталость' => $this->integer(),
            'morale' => $this->integer(), // мораль
            'wellness' => $this->integer(), // Состояние
        ]);

        $this->createTable('squad', [
            'id' => $this->primaryKey(),
            'leader_id' => $this->integer(),
            'army_id' => $this->integer(),
            'sort_order' => $this->integer(),
        ]);

        $this->createTable('army', [
            'id' => $this->primaryKey(),
            'leader_id' => $this->integer(),

            'culture' => $this->integer(),
            'religion' =>$this->integer(),
            'caste' => $this->integer(),

            'level' => $this->integer(),
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
