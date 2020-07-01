<?php

namespace wdmg\tasks\models;

use Yii;
use \wdmg\base\models\ActiveRecord;
use \yii\behaviors\TimeStampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tasks_subunits".
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $owner_id
 * @property string $users_id
 * @property string $created_at
 * @property string $updated_at
 * @property int $status
 */
class TasksSubunits extends ActiveRecord
{
    /**
     * Subdivision status
     * const, int: 10 - Not Active, 20 - Active
     */
    const SUB_STATUS_DISABLE = 10;
    const SUB_STATUS_ACTIVE = 20;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tasks_subunits}}';
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
     * @var Instance of current module
     */
    private $_module;

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
        return [
            [['description', 'users_id'], 'string'],
            [['owner_id'], 'required'],
            [['owner_id', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
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
            'owner_id' => Yii::t('app/modules/tasks', 'Owner ID'),
            'users_id' => Yii::t('app/modules/tasks', 'Users ID'),
            'created_at' => Yii::t('app/modules/tasks', 'Created At'),
            'updated_at' => Yii::t('app/modules/tasks', 'Updated At'),
            'status' => Yii::t('app/modules/tasks', 'Status'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function afterFind()
    {

        if (is_string($this->users_id))
            $this->users_id = \explode(',', $this->users_id);

        parent::afterFind();
    }

    /**
     * {@inheritdoc}
     */
    public function beforeSave($insert)
    {
        if (is_array($this->users_id))
            $this->users_id = \implode(',', $this->users_id);

        return parent::beforeSave($insert);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        if (class_exists('\wdmg\users\models\Users') && $this->_module->moduleLoaded('users'))
            return $this->hasMany(\wdmg\users\models\Users::class, ['id' => 'users_id']);
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
            self::SUB_STATUS_DISABLE => Yii::t('app/modules/tasks','Not active'),
            self::SUB_STATUS_ACTIVE => Yii::t('app/modules/tasks','Active'),
        ]);

        return $list;
    }
}
