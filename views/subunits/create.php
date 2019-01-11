<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model wdmg\tasks\models\TasksSubunits */

$this->title = Yii::t('app/modules/tasks', 'Create subunits');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tasks', 'Tasks'), 'url' => ['../tasks']];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tasks', 'Tasks Subunits'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-header">
    <h1><?= Html::encode($this->title) ?> <small class="text-muted pull-right">[v.<?= $this->context->module->version ?>]</small></h1>
</div>
<div class="tasks-subunits-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
