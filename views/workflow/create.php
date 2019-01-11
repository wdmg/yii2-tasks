<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model wdmg\tasks\models\TasksWorkflow */

$this->title = Yii::t('app/modules/tasks', 'Create tasks workflow');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tasks', 'Tasks'), 'url' => ['../tasks']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tasks', 'Workflows'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <h1><?= Html::encode($this->title) ?> <small class="text-muted pull-right">[v.<?= $this->context->module->version ?>]</small></h1>
</div>
<div class="tasks-workflow-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
