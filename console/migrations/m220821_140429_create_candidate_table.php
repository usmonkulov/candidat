<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%candidate}}`.
 */
class m220821_140429_create_candidate_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%candidate}}', [
            'id'                => $this->primaryKey(),
            'first_name'        => $this->string()->notNull(),
            'last_name'         => $this->string()->notNull(),
            'middle_name'       => $this->string(),
            'address'           => $this->text()->notNull(),
            'country_origin'    => $this->string()->notNull(),
            'email'             => $this->string(50),
            'phone'             => $this->string(50)->notNull(),
            'birthday'          => $this->date()->notNull(),
            'hired'             => $this->boolean()->defaultValue(false)->notNull(),
            'gender'            => $this->string(1)->defaultValue('m')->notNull(),
            'status'            => $this->smallInteger()->defaultValue(1)->notNull(),
            'is_deleted'        => $this->smallInteger()->defaultValue(1)->notNull(),
            'token'             => $this->string(50)->notNull(),
            'request_no'        => $this->string(50)->notNull(),
            'created_by'        => $this->integer()->notNull(),
            'updated_by'        => $this->integer(),
            'created_at'        => $this->timestamp()->notNull()->defaultValue('NOW()'),
            'updated_at'        => $this->timestamp(),
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-candidate-created_by}}',
            '{{%candidate}}',
            'created_by'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-candidate-created_by}}',
            '{{%candidate}}',
            'created_by',
            '{{%users}}',
            'id',
            'RESTRICT',
            'CASCADE',
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-candidate-updated_by}}',
            '{{%candidate}}',
            'updated_by'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-candidate-updated_by}}',
            '{{%candidate}}',
            'updated_by',
            '{{%users}}',
            'id',
            'RESTRICT',
            'CASCADE',
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-candidate-created_by}}',
            '{{%candidate}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-candidate-created_by}}',
            '{{%candidate}}'
        );

        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-candidate-updated_by}}',
            '{{%candidate}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-candidate-updated_by}}',
            '{{%candidate}}'
        );

        $this->dropTable('{{%candidate}}');
    }
}
