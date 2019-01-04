<?php

use yii\db\Migration;

/**
 * Class m180103_201324_tasks
 */
class m180103_201324_tasks extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tasks%}}', [
            'id' => $this->primaryKey(), // Primary key ID (int)
            'title' => $this->string(255), // Region title (string)
            'description' => $this->text(), // Task description (string)
            'ticket_id' => $this->integer()->null(), // ID ticket (int) `tasks`.`id`
            'owner_id' => $this->integer()->notNull(), // Job created (int) `users`.`id`
            'executor_id' => $this->integer()->null(), // Task performer (int) `users`.`id`
            'deadline_at' => $this->datetime()->defaultExpression('CURRENT_TIMESTAMP'), // Task deadline date (timestamp)
            'started_at' => $this->datetime()->defaultExpression('CURRENT_TIMESTAMP'), // Task started date (timestamp)
            'completed_at' => $this->datetime()->defaultExpression('CURRENT_TIMESTAMP'), // Task complated date (timestamp)
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'), // Task created date (timestamp)
            'updated_at' => $this->datetime()->defaultExpression('CURRENT_TIMESTAMP'), // Task updated date (timestamp)
            'status' => $this->integer(2)->notNull()->defaultValue(10), // Task status (int): 10 - Progress, 20 - Complete, 30 - Unsuccessfully, 40 - Suspended
        ], $tableOptions);

        $this->addForeignKey(
            'fk_tasks_to_users',
            '{{%tasks%}}',
            [
                'owner_id',
                'executor_id'
            ],
            '{{%users%}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('{{%tasks%}}');
        $this->dropTable('{{%tasks%}}');
    }
}
