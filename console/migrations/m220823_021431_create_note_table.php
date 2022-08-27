<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%note}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 * - `{{%candidate}}`
 */
class m220823_021431_create_note_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%note}}', [
            'candidate_id'      => $this->primaryKey(),
            'deadline'          => $this->integer()->notNull(),
            'description'       => $this->string()->notNull(),
            'created_by'        => $this->integer()->notNull(),
            'updated_by'        => $this->integer(),
            'created_at'        => $this->timestamp()->notNull()->defaultValue('NOW()'),
            'updated_at'        => $this->timestamp(),
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-note-created_by}}',
            '{{%note}}',
            'created_by'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-note-created_by}}',
            '{{%note}}',
            'created_by',
            '{{%users}}',
            'id',
            'RESTRICT',
            'CASCADE',
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-note-updated_by}}',
            '{{%note}}',
            'updated_by'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-note-updated_by}}',
            '{{%note}}',
            'updated_by',
            '{{%users}}',
            'id',
            'RESTRICT',
            'CASCADE',
        );

        // creates index for column `candidate_id`
        $this->createIndex(
            '{{%idx-note-candidate_id}}',
            '{{%note}}',
            'candidate_id'
        );

        // add foreign key for table `{{%candidate}}`
        $this->addForeignKey(
            '{{%fk-note-candidate_id}}',
            '{{%note}}',
            'candidate_id',
            '{{%candidate}}',
            'id',
            'CASCADE',
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
            '{{%fk-note-created_by}}',
            '{{%note}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-note-created_by}}',
            '{{%note}}'
        );

        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-note-updated_by}}',
            '{{%note}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-note-updated_by}}',
            '{{%note}}'
        );

        // drops foreign key for table `{{%candidate}}`
        $this->dropForeignKey(
            '{{%fk-note-candidate_id}}',
            '{{%note}}'
        );

        // drops index for column `candidate_id`
        $this->dropIndex(
            '{{%idx-note-candidate_id}}',
            '{{%note}}'
        );

        $this->dropTable('{{%note}}');
    }
}
