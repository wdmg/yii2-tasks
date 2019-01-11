<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model wdmg\tasks\models\TasksSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h5 class="panel-title">
            <a data-toggle="collapse" href="#tasksSearch">
                <span class="glyphicon glyphicon-search"></span> <?= Yii::t('app/modules/tasks', 'Tasks search') ?>
            </a>
        </h5>
    </div>
    <div id="tasksSearch" class="panel-collapse collapse">
        <div class="panel-body">
            <div class="tasks-search">

                <?php $form = ActiveForm::begin([
                    'action' => ['index'],
                    'method' => 'get',
                    'options' => [
                        'data-pjax' => 1
                    ],
                ]); ?>

                <?= $form->field($model, 'id') ?>

                <?= $form->field($model, 'title') ?>

                <?= $form->field($model, 'description') ?>

                <?= $form->field($model, 'ticket_id') ?>

                <?= $form->field($model, 'owner_id') ?>

                <?php // echo $form->field($model, 'executor_id') ?>

                <?php // echo $form->field($model, 'deadline_at') ?>

                <?php // echo $form->field($model, 'started_at') ?>

                <?php // echo $form->field($model, 'completed_at') ?>

                <?php // echo $form->field($model, 'created_at') ?>

                <?php // echo $form->field($model, 'updated_at') ?>

                <?php // echo $form->field($model, 'status') ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app/modules/tasks', 'Search'), ['class' => 'btn btn-primary']) ?>
                    <?= Html::resetButton(Yii::t('app/modules/tasks', 'Reset'), ['class' => 'btn btn-default']) ?>
                </div>

                <?php ActiveForm::end(); ?>

            </div>
        </div>
    </div>
</div>
