<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel wdmg\tasks\models\TasksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/modules/tasks', 'My tasks');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tasks', 'Tasks'), 'url' => ['list/all']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="page-header">
    <h1><?= Html::encode($this->title) ?> <small class="text-muted pull-right">[v.<?= $this->context->module->version ?>]</small></h1>
</div>
<div class="tasks-index">

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '{summary}<br\/>{items}<br\/>{summary}<br\/><div class="text-center">{pager}</div>',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            [
                'attribute' => 'description',
                'format' => 'raw',
                'value' => function($model) {
                    return strip_tags($model->description);
                }
            ],
            [
                'attribute' => 'ticket_id',
                'format' => 'raw',
                'header' => Yii::t('app/modules/tasks', 'Ticket'),
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
                'attribute' => 'executor_id',
                'format' => 'raw',
                'header' => Yii::t('app/modules/tasks', 'Executor'),
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
                'format' => 'datetime',
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ]
            ],
            [
                'attribute' => 'started_at',
                'format' => 'datetime',
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ]
            ],
            [
                'attribute' => 'completed_at',
                'format' => 'datetime',
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ]
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'filter' => false,
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ],
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

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t('app/modules/tasks', 'Actions'),
                'contentOptions' => [
                    'class' => 'text-center'
                ],
                'urlCreator' => function ($action, $model, $key, $index) {

                    if ($action === 'view')
                        return \yii\helpers\Url::toRoute(['item/view', 'id' => $key]);

                    if ($action === 'update')
                        return \yii\helpers\Url::toRoute(['item/update', 'id' => $key]);

                    if ($action === 'delete')
                        return \yii\helpers\Url::toRoute(['item/delete', 'id' => $key]);

                }
            ],
        ],
        'pager' => [
            'options' => [
                'class' => 'pagination',
            ],
            'maxButtonCount' => 5,
            'activePageCssClass' => 'active',
            'linkContainerOptions' => [
                'class' => 'linkContainerOptions',
            ],
            'linkOptions' => [
                'class' => 'linkOptions',
            ],
            'prevPageCssClass' => '',
            'nextPageCssClass' => '',
            'firstPageCssClass' => 'previous',
            'lastPageCssClass' => 'next',
            'firstPageLabel' => Yii::t('app/modules/tasks', 'First page'),
            'lastPageLabel'  => Yii::t('app/modules/tasks', 'Last page'),
            'prevPageLabel'  => Yii::t('app/modules/tasks', '&larr; Prev page'),
            'nextPageLabel'  => Yii::t('app/modules/tasks', 'Next page &rarr;')
        ],
    ]); ?>

    <div>
        <?= Html::a(Yii::t('app/modules/tasks', 'Add new task'), ['item/create'], ['class' => 'btn btn-success pull-right']) ?>
    </div>
    <?php Pjax::end(); ?>
</div>

<?php echo $this->render('../_debug'); ?>
