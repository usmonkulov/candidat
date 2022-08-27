<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m220820_193434_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id'                    => $this->primaryKey(),
            'username'              => $this->string()->notNull()->unique(),
            'auth_key'              => $this->string(32)->notNull(),
            'password_hash'         => $this->string()->notNull(),
            'password_reset_token'  => $this->string()->unique(),
            'email'                 => $this->string(50)->notNull()->unique(),
            'email_confirm_token'   => $this->string(50)->unique(),
            'phone'                 => $this->string(50)->notNull()->unique(),
            'status'                => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at'            => $this->integer()->unsigned()->notNull(),
            'updated_at'            => $this->integer()->unsigned()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
