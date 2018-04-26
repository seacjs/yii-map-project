<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170731_092945_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string()->notNull(),
            'username' => $this->string()->notNull(),

            'password_hash' => $this->string()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),

            'status' => $this->integer(),

            'auth_key' => $this->string(32),
            'email_confirm_token' => $this->string(),
            'password_reset_token' => $this->string(),
        ]);

        $this->createIndex('idx-user-username', '{{%user}}', 'username');
        $this->createIndex('idx-user-email', '{{%user}}', 'email');
        $this->createIndex('idx-user-status', '{{%user}}', 'status');

        $this->createTable('{{%house}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'money' => $this->integer(),
            'honor' => $this->integer(), // честь, как честь дайме в сегуне

            'name' => $this->string(),
            'banner' => $this->string(),
        ]);

        $this->createIndex('idx-house-user_id','{{%house}}','user_id');
        $this->addForeignKey('fk-house-user_id','{{%house}}','user_id','{{%user}}','id', 'CASCADE','CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%house}}');
        $this->dropTable('{{%user}}');
    }
}
