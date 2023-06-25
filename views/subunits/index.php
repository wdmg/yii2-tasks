<?php

use wdmg\widgets\SelectInput;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel wdmg\tasks\models\TasksSubunitsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/modules/tasks', 'Subdivisions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tasks', 'Tasks'), 'url' => ['../tasks']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-subunits-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description:ntext',
            [
                'attribute' => 'owner_id',
                'format' => 'raw',
                'header' => Yii::t('app/modules/tasks', 'Owner'),
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
                'header' => Yii::t('app/modules/tasks', 'Users'),
                'value' => function($model) {
                    if (is_array($model->users)) {

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
            //'created_at',
            //'updated_at',

            [
                'attribute' => 'status',
                'format' => 'html',
                'filter' => SelectInput::widget([
                    'model' => $searchModel,
                    'attribute' => 'status',
                    'items' => $searchModel->getStatusesList(true),
                    'options' => [
                        'id' => 'subunit-status',
                        'class' => 'form-control'
                    ]
                ]),
                'headerOptions' => [
                    'class' => 'text-center'
                ],
                'contentOptions' => [
                    'class' => 'text-center'
                ],
                'value' => function($data) {

                    if ($data->status == $data::SUB_STATUS_DISABLE)
                        return '<span class="label label-default">'.Yii::t('app/modules/tasks','Not active').'</span>';
                    elseif ($data->status == $data::SUB_STATUS_ACTIVE)
                        return '<span class="label label-success">'.Yii::t('app/modules/tasks','Active').'</span>';
                    else
                        return false;

                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
        'pager' => [
            'options' => [
                'class' => 'pagination',
            ],
            'maxButtonCount' => 5,
            'activePageCssClass' => 'active',
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
    <hr/>
    <div>
        <?= Html::a(Yii::t('app/modules/tasks', 'Create subdivision'), ['subunits/create'], ['class' => 'btn btn-add btn-success pull-right']) ?>
    </div>
    <?php Pjax::end(); ?>
</div>
