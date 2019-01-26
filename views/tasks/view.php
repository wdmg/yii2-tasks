<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use wdmg\helpers\DateAndTime;

/* @var $this yii\web\View */
/* @var $model wdmg\tasks\models\Tasks */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tasks', 'Tasks'), 'url' => ['list/all']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="page-header">
    <h1><?= Html::encode($this->title) ?> <small class="text-muted pull-right">[v.<?= $this->context->module->version ?>]</small></h1>
</div>
<div class="tasks-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            [
                'attribute' => 'ticket_id',
                'format' => 'html',
                'label' => Yii::t('app/modules/tasks', 'Ticket'),
                'value' => function($model) {
                    if($model->ticket_id == $model->ticket['id'])
                        if($model->ticket['id'] && $model->ticket['subject'])
                            return Html::a($model->ticket['subject'], ['../admin/tickets/item/view/?id='.$model->ticket['id']], [
                                'target' => '_blank',
                                'data-pjax' => 0
                            ]);
                        else
                            return $model->ticket_id;
                    else
                        return $model->ticket_id;
                }
            ],
            [
                'attribute' => 'owner_id',
                'format' => 'html',
                'label' => Yii::t('app/modules/tasks', 'Owner'),
                'value' => function($model) {
                    if($model->owner_id == $model->owner['id'])
                        if($model->owner['id'] && $model->owner['username'])
                            return Html::a($model->owner['username'], ['../admin/users/view/?id='.$model->owner['id']], [
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
                'attribute' => 'executor_id',
                'format' => 'html',
                'label' => Yii::t('app/modules/tasks', 'Executor'),
                'value' => function($model) {
                    if($model->executor_id == $model->executor['id'])
                        if($model->executor['id'] && $model->executor['username'])
                            return Html::a($model->executor['username'], ['../admin/users/view/?id='.$model->executor['id']], [
                                'target' => '_blank',
                                'data-pjax' => 0
                            ]);
                        else
                            return $model->executor_id;
                    else
                        return $model->executor_id;
                }
            ],
            [
                'attribute' => 'deadline_at',
                'format' => 'html',
                'value' => function($data) {
                    return \Yii::$app->formatter->asDatetime($data->deadline_at) . DateAndTime::diff($data->deadline_at." ", null, [
                        'layout' => '<small class="pull-right {class}">[ {datetime} ]</small>',
                        'inpastClass' => 'text-danger',
                        'futureClass' => 'text-success',
                    ]);
                }
            ],
            [
                'attribute' => 'started_at',
                'format' => 'html',
                'value' => function($data) {
                    return \Yii::$app->formatter->asDatetime($data->started_at) . DateAndTime::diff($data->started_at." ", null, [
                        'layout' => '<small class="pull-right {class}">[ {datetime} ]</small>',
                        'inpastClass' => 'text-danger',
                        'futureClass' => 'text-success',
                    ]);
                }
            ],
            [
                'attribute' => 'completed_at',
                'format' => 'html',
                'value' => function($data) {
                    return \Yii::$app->formatter->asDatetime($data->completed_at) . DateAndTime::diff($data->completed_at." ", null, [
                        'layout' => '<small class="pull-right {class}">[ {datetime} ]</small>',
                        'inpastClass' => 'text-danger',
                        'futureClass' => 'text-success',
                    ]);
                }
            ],
            [
                'attribute' => 'created_at',
                'format' => 'html',
                'value' => function($data) {
                    return \Yii::$app->formatter->asDatetime($data->created_at) . DateAndTime::diff($data->created_at." ", null, [
                            'layout' => '<small class="pull-right {class}">[ {datetime} ]</small>',
                            'inpastClass' => 'text-danger',
                            'futureClass' => 'text-success',
                        ]);
                }
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'html',
                'value' => function($data) {
                    return \Yii::$app->formatter->asDatetime($data->updated_at) . DateAndTime::diff($data->updated_at." ", null, [
                            'layout' => '<small class="pull-right {class}">[ {datetime} ]</small>',
                            'inpastClass' => 'text-danger',
                            'futureClass' => 'text-success',
                        ]);
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function($data) {

                    if ($data->status == $data::TS_STATUS_WATING)
                        return '<span class="label label-default">'.Yii::t('app/modules/tasks','Wating').'</span>';
                    elseif ($data->status == $data::TS_STATUS_PROGRESS)
                        return '<span class="label label-success">'.Yii::t('app/modules/tasks','Progress').'</span>';
                    elseif ($data->status == $data::TS_STATUS_COMPLETE)
                        return '<b class="text-success">'.Yii::t('app/modules/tasks','Complete').'</b>';
                    elseif ($data->status == $data::TS_STATUS_UNSUCCESS)
                        return '<span class="label label-danger">'.Yii::t('app/modules/tasks','Unsuccessfully').'</span>';
                    elseif ($data->status == $data::TS_STATUS_SUSPENDED)
                        return '<span class="label label-warning">'.Yii::t('app/modules/tasks','Suspended').'</span>';
                    elseif ($data->status == $data::TS_STATUS_CANCELED)
                        return '<b class="text-danger">'.Yii::t('app/modules/tasks','Canceled').'</b>';
                    else
                        return false;

                },
            ],
        ],
    ]) ?>

    <hr/>
    <?php if ($model->status !== $model::TS_STATUS_COMPLETE && $model->status !== $model::TS_STATUS_UNSUCCESS) : ?>
    <div class="form-group">
        <label><?= Yii::t('app/modules/tasks', 'Change task status on') ?>: </label>
        <?php
            if($model->status !== $model::TS_STATUS_WATING)
                echo Html::a(Yii::t('app/modules/tasks', 'Wating'), ['item/set/', 'id' => $model->id, 'status' => $model::TS_STATUS_WATING], ['class' => 'btn btn-default', 'style' => 'margin-left: 1rem;']);

            if($model->status !== $model::TS_STATUS_PROGRESS)
                echo Html::a(Yii::t('app/modules/tasks', 'Progress'), ['item/set/', 'id' => $model->id, 'status' => $model::TS_STATUS_PROGRESS], ['class' => 'btn btn-success', 'style' => 'margin-left: 1rem;']);

            if($model->status !== $model::TS_STATUS_COMPLETE)
                echo Html::a(Yii::t('app/modules/tasks', 'Complete'), ['item/set/', 'id' => $model->id, 'status' => $model::TS_STATUS_COMPLETE], ['class' => 'btn btn-success', 'style' => 'margin-left: 1rem;']);

            if($model->status !== $model::TS_STATUS_SUSPENDED)
                echo Html::a(Yii::t('app/modules/tasks', 'Suspended'), ['item/set/', 'id' => $model->id, 'status' => $model::TS_STATUS_SUSPENDED], ['class' => 'btn btn-warning', 'style' => 'margin-left: 1rem;']);

            if($model->status !== $model::TS_STATUS_CANCELED)
                echo Html::a(Yii::t('app/modules/tasks', 'Canceled'), ['item/set/', 'id' => $model->id, 'status' => $model::TS_STATUS_CANCELED], ['class' => 'btn btn-danger', 'style' => 'margin-left: 1rem;']);

        ?>&nbsp;
    </div>
    <hr/>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::a(Yii::t('app/modules/tasks', '&larr; Back to list'), ['list/all'], ['class' => 'btn btn-default pull-left']) ?>&nbsp;
        <?= Html::a(Yii::t('app/modules/tasks', 'Edit'), ['item/update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app/modules/tasks', 'Delete'), ['item/delete', 'id' => $model->id], [
            'class' => 'btn btn-danger pull-right',
            'data' => [
                'confirm' => Yii::t('app/modules/tasks', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>

</div>
