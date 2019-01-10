<?php

namespace wdmg\tasks\models;

use Yii;

/**
 * This is the model class for table "tasks".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $ticket_id
 * @property int $owner_id
 * @property int $executor_id
 * @property string $deadline_at
 * @property string $started_at
 * @property string $completed_at
 * @property string $created_at
 * @property string $updated_at
 * @property int $status
 *
 * @property TasksWorkflow[] $tasksWorkflows
 * @property Tickets[] $tickets
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description'], 'string'],
            [['ticket_id', 'owner_id', 'executor_id', 'status'], 'integer'],
            [['owner_id'], 'required'],
            [['deadline_at', 'started_at', 'completed_at', 'created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/modules/tasks', 'ID'),
            'title' => Yii::t('app/modules/tasks', 'Title'),
            'description' => Yii::t('app/modules/tasks', 'Description'),
            'ticket_id' => Yii::t('app/modules/tasks', 'Ticket ID'),
            'owner_id' => Yii::t('app/modules/tasks', 'Owner ID'),
            'executor_id' => Yii::t('app/modules/tasks', 'Executor ID'),
            'deadline_at' => Yii::t('app/modules/tasks', 'Deadline At'),
            'started_at' => Yii::t('app/modules/tasks', 'Started At'),
            'completed_at' => Yii::t('app/modules/tasks', 'Completed At'),
            'created_at' => Yii::t('app/modules/tasks', 'Created At'),
            'updated_at' => Yii::t('app/modules/tasks', 'Updated At'),
            'status' => Yii::t('app/modules/tasks', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasksWorkflows()
    {
        return $this->hasMany(TasksWorkflow::className(), ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Tickets::className(), ['task_id' => 'id']);
    }
}
