<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wdmg\widgets\DatePicker;
use wdmg\widgets\SelectInput;
use wdmg\widgets\Editor;

/* @var $this yii\web\View */
/* @var $model wdmg\tasks\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(Editor::class, [
        'options' => [],
        'pluginOptions' => []
    ]) ?>

    <?= $form->field($model, 'ticket_id')->textInput() ?>

    <?= $form->field($model, 'owner_id')->textInput() ?>

    <?= $form->field($model, 'executor_id')->textInput() ?>

    <?= $form->field($model, 'deadline_at')->widget(DatePicker::class, [
        'options' => [
            'id' => 'task-form-deadline_at',
            'class' => 'form-control'
        ],
        'pluginOptions' => [
            'className' => '.datepicker',
            'input' => '.form-control',
            'toggle' => '.input-group-btn > button',
            'format' => 'YYYY-MM-DD HH:mm:ss'
        ]
    ]); ?>

    <?= $form->field($model, 'started_at')->widget(DatePicker::class, [
        'options' => [
            'id' => 'task-form-started_at',
            'class' => 'form-control'
        ],
        'pluginOptions' => [
            'className' => '.datepicker',
            'input' => '.form-control',
            'toggle' => '.input-group-btn > button',
            'format' => 'YYYY-MM-DD HH:mm:ss'
        ]
    ]); ?>

    <?= $form->field($model, 'completed_at')->widget(DatePicker::class, [
        'options' => [
            'id' => 'task-form-completed_at',
            'class' => 'form-control'
        ],
        'pluginOptions' => [
            'className' => '.datepicker',
            'input' => '.form-control',
            'toggle' => '.input-group-btn > button',
            'format' => 'YYYY-MM-DD HH:mm:ss'
        ]
    ]); ?>

    <?= $form->field($model, 'status')->widget(SelectInput::class, [
        'items' => $model->getStatusesList(),
        'options' => [
            'id' => 'task-form-status',
            'class' => 'form-control'
        ]
    ]); ?>

    <hr/>
    <div class="form-group">
        <?= Html::a(Yii::t('app/modules/tasks', '&larr; Back to list'), ['list/all'], ['class' => 'btn btn-default pull-left']) ?>&nbsp;
        <?= Html::submitButton(Yii::t('app/modules/tasks', 'Save'), ['class' => 'btn btn-save btn-success pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
