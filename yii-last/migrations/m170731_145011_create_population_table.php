<?php

use yii\db\Migration;

/**
 * Handles the creation of table `house`.
 */
class m170731_145011_create_population_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('population', [
            'id' => $this->primaryKey(),
            'region_id' => $this->integer(),

            'age' =>$this->integer(), // возраст группы (под вопросом)
            'culture' =>$this->integer(),
            'religion' =>$this->integer(),
            'caste' => $this->integer(),

            /* ПОТРЕБНОСТИ связи с таблицей product */
            /* которые будут расчитываться ежедневно */
            /* и люди будут их сами покупать, сначала будут более верхние слои общества, затем более нижние */
            /* при расчета выборка будет сначала в пользу богатых, затем в пользу более больших масс населения */

            // Пища
            // Мебель
            // Одежда
            // Личное оружие
            // Интрументы
            // Выпивка
            // Товары роскоши
            // Украшения и

            'people' => $this->integer(),

            'happiness' => $this->integer(),
            'money' => $this->integer(),
            'health' => $this->integer(),
        ]);

        $this->addForeignKey('fk-population-region_id','population', 'region_id', 'region', 'id', 'CASCADE','CASCADE');

        $this->createIndex('idx-population-region_id','population','region_id');

        $this->createIndex('idx-population-people','population','people');
        $this->createIndex('idx-population-happiness','population','happiness');
        $this->createIndex('idx-population-money','population','money');
        $this->createIndex('idx-population-health','population','health');

    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('population');
    }
}
