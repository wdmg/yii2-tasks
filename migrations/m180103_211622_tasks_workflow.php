<?php

use yii\db\Migration;

/**
 * Class m180103_211622_tasks_workflow
 */
class m180103_211622_tasks_workflow extends Migration
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

        $this->createTable('{{%tasks_workflow%}}', [
            'id' => $this->primaryKey(), // Primary key ID (int)
            'ticket_id' => $this->integer()->null(), // ID ticket (int) `tasks`.`id`
            'owner_id' => $this->integer()->notNull(), // Process created (int) `users`.`id`
            'owner_id' => $this->integer()->null(), // Process performer (int) `users`.`id`
            'description' => $this->text(), // Process description (string)
            'deadline_at' => $this->datetime()->defaultExpression('CURRENT_TIMESTAMP'), // Process deadline date (timestamp)
            'started_at' => $this->datetime()->defaultExpression('CURRENT_TIMESTAMP'), // Process started date (timestamp)
            'completed_at' => $this->datetime()->defaultExpression('CURRENT_TIMESTAMP'), // Process complated date (timestamp)
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'), // Process created date (timestamp)
            'updated_at' => $this->datetime()->defaultExpression('CURRENT_TIMESTAMP'), // Process updated date (timestamp)
            'status' => $this->integer(2)->notNull()->defaultValue(10), // Process status (int): 10 - Started, 20 - Completed
        ], $tableOptions);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->truncateTable('{{%tasks_workflow%}}');
        $this->dropTable('{{%tasks_workflow%}}');
    }
}
