<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model wdmg\tasks\models\Tasks */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'ticket_id')->textInput() ?>

    <?= $form->field($model, 'owner_id')->textInput() ?>

    <?= $form->field($model, 'executor_id')->textInput() ?>

    <?= $form->field($model, 'deadline_at')->textInput() ?>

    <?= $form->field($model, 'started_at')->textInput() ?>

    <?= $form->field($model, 'completed_at')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([
        $model::TS_STATUS_WATING => Yii::t('app/modules/tasks','Wating'),
        $model::TS_STATUS_PROGRESS => Yii::t('app/modules/tasks','Progress'),
        $model::TS_STATUS_COMPLETE => Yii::t('app/modules/tasks','Complete'),
        $model::TS_STATUS_UNSUCCESS => Yii::t('app/modules/tasks','Unsuccessfully'),
        $model::TS_STATUS_SUSPENDED => Yii::t('app/modules/tasks','Suspended'),
        $model::TS_STATUS_CANCELED => Yii::t('app/modules/tasks','Canceled'),
    ]); ?>

    <hr/>
    <div class="form-group">
        <?= Html::a(Yii::t('app/modules/tasks', '&larr; Back to list'), ['tasks/index'], ['class' => 'btn btn-default pull-left']) ?>&nbsp;
        <?= Html::submitButton(Yii::t('app/modules/tasks', 'Save'), ['class' => 'btn btn-success pull-right']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
