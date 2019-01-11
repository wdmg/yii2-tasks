<?php

use yii\db\Migration;

/**
 * Class m180111_182318_import
 */
class m180111_182318_import extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        for ($i = 1; $i <= 10; $i++) {
            $this->insert('{{tasks}}', [
                'title' => 'Test task #'.$i,
                'description' => 'The description of '.$i.' task',
                'ticket_id' => rand(5, 8),
                'owner_id' => 1,
                'executor_id' => 2,
                'deadline_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d") . " +".rand(7, 8)." days")),
                'started_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d") . " +".rand(1, 3)." days")),
                'completed_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d") . " +".rand(4, 6)." days")),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d") . " +".rand(8, 9)." days")),
                'status' => intval(rand(1, 6).'0')
            ]);
        }

        for ($i = 1; $i <= 3; $i++) {
            $this->insert('{{tasks_subunits}}', [
                'title' => 'Some subdivision #'.$i,
                'description' => 'Some subdivision description',
                'owner_id' => 1,
                'users_id' => '2,3,4,5',
                'created_at' => date("Y-m-d H:i:s"),
                'created_at' => date("Y-m-d H:i:s"),
                'status' => intval(rand(1, 2).'0')
            ]);
        }

        for ($i = 1; $i <= 5; $i++) {
            $this->insert('{{tasks_workflow}}', [
                'task_id' => rand(1, 6),
                'owner_id' => 1,
                'assigned_id' => rand(2, 5),
                'description' => 'Some workflow of task #'.$i,
                'deadline_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d") . " +".rand(2, 4)." days")),
                'started_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d") . " +".rand(1, 2)." days")),
                'completed_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d") . " +".rand(2, 3)." days")),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s", strtotime(date("Y-m-d") . " +".rand(4, 5)." days")),
                'status' => intval(rand(1, 2).'0')
            ]);
        }

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }
}
