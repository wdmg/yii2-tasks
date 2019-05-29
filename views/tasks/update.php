<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model wdmg\tasks\models\Tasks */

$this->title = Yii::t('app/modules/tasks', 'Update task: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => $this->context->module->name, 'url' => ['list/all']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app/modules/tasks', 'Update');
?>
<div class="tasks-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
