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
            'world_id' => $this->integer(),
            'region_id' => $this->integer(),

            'age' =>$this->integer(), // возраст группы
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

            'happiness' => $this->integer(),
            'money' => $this->integer(),
            'people' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('population');
    }
}
