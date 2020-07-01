<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model wdmg\tasks\models\TasksSubunits */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tasks', 'Tasks'), 'url' => ['../tasks']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tasks', 'Subdivisions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tasks-subunits-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            [
                'attribute' => 'owner_id',
                'format' => 'html',
                'label' => Yii::t('app/modules/tasks', 'Owner'),
                'value' => function($model) {
                    if($model->owner_id == $model->owner['id'])
                        if($model->owner['id'] && $model->owner['username'])
                            return Html::a($model->owner['username'], ['../users/users/view', 'id' => $model->owner['id']], [
                                'target' => '_blank',
                                'data-pjax' => 0
                            ]);
                        else
                            return $model->owner_id;
                    else
                        return $model->owner_id;
                }
            ],
            [
                'attribute' => 'users_id',
                'format' => 'raw',
                'label' => Yii::t('app/modules/tasks', 'Users'),
                'value' => function($model) {
                    if (is_countable($model->users)) {

                        $output = '';
                        foreach ($model->users as $user) {

                            if (!empty($output))
                                $output .= ', ';

                            $output .= Html::a($user->username, ['../users/users/view', 'id' => $user->id], [
                                'target' => '_blank',
                                'data-pjax' => 0
                            ]);

                        }

                        if (!empty($output))
                            return $output;
                        else
                            return null;

                    } else {
                        return $model->users_id;
                    }
                }
            ],
            'created_at',
            'updated_at',
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function($data) {

                    if ($data->status == $data::SUB_STATUS_DISABLE)
                        return '<span class="label label-default">'.Yii::t('app/modules/tasks','Not active').'</span>';
                    elseif ($data->status == $data::SUB_STATUS_ACTIVE)
                        return '<span class="label label-success">'.Yii::t('app/modules/tasks','Active').'</span>';
                    else
                        return false;

                },
            ],
        ],
    ]) ?>

    <hr/>
    <div>
        <?= Html::a(Yii::t('app/modules/tasks', 'Update'), ['subunits/update', 'id' => $model->id], ['class' => 'btn btn-edit btn-primary pull-right']) ?>
        <?= Html::a(Yii::t('app/modules/tasks', 'Delete'), ['subunits/delete', 'id' => $model->id], [
            'class' => 'btn btn-delete btn-danger',
            'data' => [
                'confirm' => Yii::t('app/modules/tasks', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>

</div>
