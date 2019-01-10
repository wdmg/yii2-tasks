<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model wdmg\tasks\models\Tasks */

$this->title = Yii::t('app/modules/tasks', 'Create Tasks');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tasks', 'Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
