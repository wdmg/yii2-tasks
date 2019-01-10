<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model wdmg\tasks\models\TasksWorkflow */

$this->title = Yii::t('app/modules/tasks', 'Create Tasks Workflow');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tasks', 'Tasks Workflows'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-workflow-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
