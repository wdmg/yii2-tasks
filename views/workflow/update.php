<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model wdmg\tasks\models\TasksWorkflow */

$this->title = Yii::t('app/modules/tasks', 'Update Tasks Workflow: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tasks', 'Tasks Workflows'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/modules/tasks', 'Update');
?>
<div class="tasks-workflow-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
