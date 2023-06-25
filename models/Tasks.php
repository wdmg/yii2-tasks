<?php

namespace wdmg\tasks\models;

use Yii;
use \wdmg\base\models\ActiveRecord;
use \yii\behaviors\TimeStampBehavior;
use yii\helpers\ArrayHelper;

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
class Tasks extends ActiveRecord
{

    /**
     * Task status
     * const, int: 10 - Wating, 20 - Progress, 30 - Complete, 40 - Unsuccessfully, 50 - Suspended, 60 - Canceled
     */
    const TS_STATUS_WATING = 10;
    const TS_STATUS_PROGRESS = 20;
    const TS_STATUS_COMPLETE = 30;
    const TS_STATUS_UNSUCCESS = 40;
    const TS_STATUS_SUSPENDED = 50;
    const TS_STATUS_CANCELED = 60;

    /**
     * @var Instance of current module
     */
    private $_module;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tasks}}';
    }

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        $this->_module = parent::getModule(true);
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    self::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
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
        $rules = [
            [['description'], 'string'],
            [['ticket_id', 'owner_id', 'executor_id', 'status'], 'integer'],
            [['owner_id'], 'required'],
            [['deadline_at', 'started_at', 'completed_at', 'created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];

        if(class_exists('\wdmg\tickets\models\Tickets') && $this->_module->moduleLoaded('tickets'))
            $rules[] = [['ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => \wdmg\tickets\models\Tickets::class, 'targetAttribute' => ['ticket_id' => 'id']];

        return $rules;
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
     * @return array
     */
    public function getStatusesList($allStatuses = false)
    {
        $list = [];
        if ($allStatuses) {
            $list = [
                '*' => Yii::t('app/modules/tasks', 'All statuses')
            ];
        }

        $list = ArrayHelper::merge($list, [
            self::TS_STATUS_WATING => Yii::t('app/modules/tasks','Wating'),
            self::TS_STATUS_PROGRESS => Yii::t('app/modules/tasks','Progress'),
            self::TS_STATUS_COMPLETE => Yii::t('app/modules/tasks','Complete'),
            self::TS_STATUS_UNSUCCESS => Yii::t('app/modules/tasks','Unsuccessfully'),
            self::TS_STATUS_SUSPENDED => Yii::t('app/modules/tasks','Suspended'),
            self::TS_STATUS_CANCELED => Yii::t('app/modules/tasks','Canceled'),
        ]);

        return $list;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTasksWorkflows()
    {
        return $this->hasMany(TasksWorkflow::class, ['task_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTicket()
    {
        if (class_exists('\wdmg\tickets\models\Tickets') && $this->_module->moduleLoaded('tickets'))
            return $this->hasOne(\wdmg\tickets\models\Tickets::class, ['id' => 'ticket_id']);
        else
            return null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOwner()
    {
        if (class_exists('\wdmg\users\models\Users') && $this->_module->moduleLoaded('users'))
            return $this->hasOne(\wdmg\users\models\Users::class, ['id' => 'owner_id']);
        else
            return null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        if (class_exists('\wdmg\users\models\Users') && $this->_module->moduleLoaded('users'))
            return $this->hasOne(\wdmg\users\models\Users::class, ['id' => 'executor_id']);
        else
            return null;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser($user_id = null)
    {
        if (class_exists('\wdmg\users\models\Users') && $this->_module->moduleLoaded('users') && !$user_id)
            return $this->hasOne(\wdmg\users\models\Users::class, ['id' => 'user_id']);
        else if (class_exists('\wdmg\users\models\Users') && $this->_module->moduleLoaded('users') && $user_id)
            return \wdmg\users\models\Users::findOne(['id' => intval($user_id)]);
        else
            return null;
    }

	/**
	 * Return stats count by all users
	 *
	 * @return array|null
	 */
	public static function getStatsCount($asArray = false) {
		$counts = static::find()
			->select([new \yii\db\Expression('SUM( CASE WHEN `created_at` >= TIMESTAMP(CURRENT_TIMESTAMP() - INTERVAL 1 DAY) THEN 1 END ) AS count')])
			->addSelect([new \yii\db\Expression('SUM( CASE WHEN `id` > 0 THEN 1 END ) AS total')]);

		if ($asArray)
			return $counts->asArray()->one();

		return $counts->one();
	}
}
