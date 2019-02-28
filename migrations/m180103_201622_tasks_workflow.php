<?php

use yii\db\Migration;

/**
 * Class m180103_201622_tasks_workflow
 */
class m180103_201622_tasks_workflow extends Migration
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

        $this->createTable('{{%tasks_workflow}}', [
            'id' => $this->primaryKey(), // Primary key ID (int)
            'task_id' => $this->integer()->notNull(), // Task ID (int) `tasks`.`id`
            'owner_id' => $this->integer()->notNull(), // Process created (int) `users`.`id`
            'assigned_id' => $this->integer()->notNull(), // Process performer (int) `users`.`id`
            'description' => $this->text(), // Process description (string)
            'deadline_at' => $this->datetime()->defaultExpression('CURRENT_TIMESTAMP'), // Process deadline date (timestamp)
            'started_at' => $this->datetime()->defaultExpression('CURRENT_TIMESTAMP'), // Process started date (timestamp)
            'completed_at' => $this->datetime()->defaultExpression('CURRENT_TIMESTAMP'), // Process complated date (timestamp)
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'), // Process created date (timestamp)
            'updated_at' => $this->datetime()->defaultExpression('CURRENT_TIMESTAMP'), // Process updated date (timestamp)
            'status' => $this->integer(2)->notNull()->defaultValue(10), // Process status (int): 10 - Started, 20 - Completed
        ], $tableOptions);

        $this->createIndex(
            'idx_tasks_workflow',
            '{{%tasks_workflow}}',
            [
                'task_id',
                'owner_id',
                'assigned_id',
            ]
        );

        if (!(Yii::$app->db->getTableSchema('{{%tasks}}', true) === null)) {
            $this->addForeignKey(
                'fk_workflow_to_tasks',
                '{{%tasks_workflow}}',
                'task_id',
                '{{%tasks}}',
                'id',
                'RESTRICT',
                'CASCADE'
            );
        }

        if (!(Yii::$app->db->getTableSchema('{{%users}}', true) === null)) {
            $this->addForeignKey(
                'fk_workflow_to_users_owner',
                '{{%tasks_workflow}}',
                'owner_id',
                '{{%users}}',
                'id',
                'RESTRICT',
                'CASCADE'
            );
            $this->addForeignKey(
                'fk_workflow_to_users_assigned',
                '{{%tasks_workflow}}',
                'assigned_id',
                '{{%users}}',
                'id',
                'RESTRICT',
                'CASCADE'
            );
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk_workflow_to_tasks',
            '{{%tasks_workflow}}'
        );

        if (!(Yii::$app->db->getTableSchema('{{%users}}', true) === null)) {
            $this->dropForeignKey(
                'fk_workflow_to_users_owner',
                '{{%tasks_workflow}}'
            );
            $this->dropForeignKey(
                'fk_workflow_to_users_assigned',
                '{{%tasks_workflow}}'
            );
        }

        $this->truncateTable('{{%tasks_workflow}}');
        $this->dropTable('{{%tasks_workflow}}');
    }
}
