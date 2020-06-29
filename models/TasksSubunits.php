<?php

namespace wdmg\tasks\models;

use Yii;
use \wdmg\base\models\ActiveRecord;
use \yii\behaviors\TimeStampBehavior;

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
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tasks_subunits}}';
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
}
