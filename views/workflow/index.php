<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel wdmg\tasks\models\TasksWorkflowSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/modules/tasks', 'Tasks Workflows');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-workflow-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app/modules/tasks', 'Create Tasks Workflow'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'task_id',
            'owner_id',
            'assigned_id',
            'description:ntext',
            //'deadline_at',
            //'started_at',
            //'completed_at',
            //'created_at',
            //'updated_at',
            //'status',

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
    <?php Pjax::end(); ?>
</div>
