<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel wdmg\tasks\models\TasksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/modules/tasks', 'Tasks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <h1><?= Html::encode($this->title) ?> <small class="text-muted pull-right">[v.<?= $this->context->module->version ?>]</small></h1>
</div>
<div class="tasks-index">

    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'layout' => '{summary}<br\/>{items}<br\/>{summary}<br\/><div class="text-center">{pager}</div>',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'title',
            'description:ntext',
            'ticket_id',
            'owner_id',
            //'executor_id',
            //'deadline_at',
            //'started_at',
            //'completed_at',
            //'created_at',
            //'updated_at',
            //'status',

            [
                'class' => 'yii\grid\ActionColumn',
                'header' => Yii::t('app/modules/tasks', 'Actions'),
                'contentOptions' => [
                    'class' => 'text-center'
                ],
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
        <!-- ?= Html::a(Yii::t('app/modules/tickets', '&larr; Back to module'), ['../admin/tasks'], ['class' => 'btn btn-default pull-left']) ? -->
        <?= Html::a(Yii::t('app/modules/tasks', 'Add new task'), ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </div>
    <?php Pjax::end(); ?>
</div>

<?php echo $this->render('../_debug'); ?>
