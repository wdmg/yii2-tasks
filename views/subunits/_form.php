<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wdmg\widgets\SelectInput;

/* @var $this yii\web\View */
/* @var $model wdmg\tasks\models\TasksSubunits */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tasks-subunits-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'owner_id')->textInput() ?>

    <?php

        $users_id = '';
        if (is_array($model->users_id))
            $users_id = \implode(',', $model->users_id);

        echo $form->field($model, 'users_id')
            ->textarea(['rows' => 6, 'value' => $users_id])
            ->label(Yii::t('app/modules/tasks', 'Users'));

    ?>

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
