<?php

use yii\db\Migration;

/**
 * Class m180103_201454_tasks_subunits
 */
class m180103_201454_tasks_subunits extends Migration
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

        $this->createTable('{{%tasks_subunits%}}', [
            'id' => $this->primaryKey(), // Primary key ID (int)
            'title' => $this->string(255), // Subdivision title (string)
            'description' => $this->text(), // Subdivision description (string)
            'owner_id' => $this->integer()->notNull(), // Subdivision created (int) `users`.`id`
            'users_id' => $this->text(), // Subdivision users (string, id by comma)
            'created_at' => $this->dateTime()->notNull()->defaultExpression('CURRENT_TIMESTAMP'), // Subdivision created date (timestamp)
            'updated_at' => $this->datetime()->defaultExpression('CURRENT_TIMESTAMP'), // Subdivision updated date (timestamp)
            'status' => $this->integer(2)->notNull()->defaultValue(10), // Subdivision status (int): 10 - Not Active, 20 - Active
        ], $tableOptions);

        $this->addForeignKey(
            'fk_subunits_to_users',
            '{{%tasks_subunits%}}',
            'owner_id',
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
        $this->truncateTable('{{%tasks_subunits%}}');
        $this->dropTable('{{%tasks_subunits%}}');
    }
}
