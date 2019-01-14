<?php

namespace wdmg\tasks\models;

use Yii;
use \yii\behaviors\TimeStampBehavior;

/**
 * This is the model class for table "tasks_workflow".
 *
 * @property int $id
 * @property int $task_id
 * @property int $owner_id
 * @property int $assigned_id
 * @property string $description
 * @property string $deadline_at
 * @property string $started_at
 * @property string $completed_at
 * @property string $created_at
 * @property string $updated_at
 * @property int $status
 *
 * @property Tasks $task
 */
class TasksWorkflow extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tasks_workflow';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => 'created_at',
                    self::EVENT_BEFORE_UPDATE => 'updated_at',
                ],
                'value' => function() {
                    return date("Y-m-d H:i:s");
                }
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task_id', 'owner_id', 'assigned_id'], 'required'],
            [['task_id', 'owner_id', 'assigned_id', 'status'], 'integer'],
            [['description'], 'string'],
            [['deadline_at', 'started_at', 'completed_at', 'created_at', 'updated_at'], 'safe'],
            [['task_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tasks::className(), 'targetAttribute' => ['task_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app/modules/tasks', 'ID'),
            'task_id' => Yii::t('app/modules/tasks', 'Task ID'),
            'owner_id' => Yii::t('app/modules/tasks', 'Owner ID'),
            'assigned_id' => Yii::t('app/modules/tasks', 'Assigned ID'),
            'description' => Yii::t('app/modules/tasks', 'Description'),
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
    public function getTask()
    {
        return $this->hasOne(Tasks::className(), ['id' => 'task_id']);
    }
}
