<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model wdmg\tasks\models\Tasks */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/modules/tasks', 'Tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="page-header">
    <h1><?= Html::encode($this->title) ?> <small class="text-muted pull-right">[v.<?= $this->context->module->version ?>]</small></h1>
</div>
<div class="tasks-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'ticket_id',
            'owner_id',
            'executor_id',
            [
                'attribute' => 'deadline_at',
                'format' => 'html',
                'value' => function($data) {

                    $datenow = new DateTime("now");
                    $deadline = new DateTime($data->deadline_at);
                    $interval = $datenow->diff($deadline);

                    $along = Yii::t(
                        'app/modules/tasks',
                        '{y, plural, =0{} =1{# year} one{# year} few{# years} many{# years} other{# years}}{y, plural, =0{} =1{, } other{, }}{m, plural, =0{} =1{# month} one{# month} few{# months} many{# months} other{# months}}{m, plural, =0{} =1{, } other{, }}{d, plural, =0{} =1{# day} one{# day} few{# days} many{# days} other{# days}}{d, plural, =0{} =1{, } other{, }}{h, plural, =0{} =1{# hour} one{# hour} few{# hours} many{# hours} other{# hours}}{h, plural, =0{} =1{, } other{, }}{i, plural, =0{} =1{# minute} one{# minute} few{# minutes} many{# minutes} other{# minutes}}{i, plural, =0{} =1{, } other{, }}{s, plural, =0{} =1{# second} one{# second} few{# seconds} many{# seconds} other{# seconds}}{invert, plural, =0{ left} =1{ ago} other{}}',
                        $interval
                    );

                    if($interval->invert == 1)
                        $along = ' <small class="pull-right text-danger">[ ' . $along . ' ]</small>';
                    else
                        $along = ' <small class="pull-right text-success">[ ' . $along . ' ]</small>';

                    return \Yii::$app->formatter->asDatetime($data->deadline_at) . $along;
                }
            ],
            [
                'attribute' => 'started_at',
                'format' => 'html',
                'value' => function($data) {

                    $datenow = new DateTime("now");
                    $started = new DateTime($data->started_at);
                    $interval = $datenow->diff($started);

                    $along = Yii::t(
                        'app/modules/tasks',
                        '{y, plural, =0{} =1{# year} one{# year} few{# years} many{# years} other{# years}}{y, plural, =0{} =1{, } other{, }}{m, plural, =0{} =1{# month} one{# month} few{# months} many{# months} other{# months}}{m, plural, =0{} =1{, } other{, }}{d, plural, =0{} =1{# day} one{# day} few{# days} many{# days} other{# days}}{d, plural, =0{} =1{, } other{, }}{h, plural, =0{} =1{# hour} one{# hour} few{# hours} many{# hours} other{# hours}}{h, plural, =0{} =1{, } other{, }}{i, plural, =0{} =1{# minute} one{# minute} few{# minutes} many{# minutes} other{# minutes}}{i, plural, =0{} =1{, } other{, }}{s, plural, =0{} =1{# second} one{# second} few{# seconds} many{# seconds} other{# seconds}}{invert, plural, =0{ left} =1{ ago} other{}}',
                        $interval
                    );

                    if($interval->invert == 1)
                        $along = ' <small class="pull-right text-danger">[ ' . $along . ' ]</small>';
                    else
                        $along = ' <small class="pull-right text-success">[ ' . $along . ' ]</small>';

                    return \Yii::$app->formatter->asDatetime($data->started_at) . $along;
                }
            ],
            [
                'attribute' => 'completed_at',
                'format' => 'html',
                'value' => function($data) {

                    $datenow = new DateTime("now");
                    $completed = new DateTime($data->completed_at);
                    $interval = $datenow->diff($completed);

                    $along = Yii::t(
                        'app/modules/tasks',
                        '{y, plural, =0{} =1{# year} one{# year} few{# years} many{# years} other{# years}}{y, plural, =0{} =1{, } other{, }}{m, plural, =0{} =1{# month} one{# month} few{# months} many{# months} other{# months}}{m, plural, =0{} =1{, } other{, }}{d, plural, =0{} =1{# day} one{# day} few{# days} many{# days} other{# days}}{d, plural, =0{} =1{, } other{, }}{h, plural, =0{} =1{# hour} one{# hour} few{# hours} many{# hours} other{# hours}}{h, plural, =0{} =1{, } other{, }}{i, plural, =0{} =1{# minute} one{# minute} few{# minutes} many{# minutes} other{# minutes}}{i, plural, =0{} =1{, } other{, }}{s, plural, =0{} =1{# second} one{# second} few{# seconds} many{# seconds} other{# seconds}}{invert, plural, =0{ left} =1{ ago} other{}}',
                        $interval
                    );

                    if($interval->invert == 1)
                        $along = ' <small class="pull-right text-danger">[ ' . $along . ' ]</small>';
                    else
                        $along = ' <small class="pull-right text-success">[ ' . $along . ' ]</small>';

                    return \Yii::$app->formatter->asDatetime($data->completed_at) . $along;
                }
            ],
            [
                'attribute' => 'created_at',
                'format' => 'html',
                'value' => function($data) {

                    $datenow = new DateTime("now");
                    $created = new DateTime($data->created_at);
                    $interval = $datenow->diff($created);

                    $along = Yii::t(
                        'app/modules/tasks',
                        '{y, plural, =0{} =1{# year} one{# year} few{# years} many{# years} other{# years}}{y, plural, =0{} =1{, } other{, }}{m, plural, =0{} =1{# month} one{# month} few{# months} many{# months} other{# months}}{m, plural, =0{} =1{, } other{, }}{d, plural, =0{} =1{# day} one{# day} few{# days} many{# days} other{# days}}{d, plural, =0{} =1{, } other{, }}{h, plural, =0{} =1{# hour} one{# hour} few{# hours} many{# hours} other{# hours}}{h, plural, =0{} =1{, } other{, }}{i, plural, =0{} =1{# minute} one{# minute} few{# minutes} many{# minutes} other{# minutes}}{i, plural, =0{} =1{, } other{, }}{s, plural, =0{} =1{# second} one{# second} few{# seconds} many{# seconds} other{# seconds}}{invert, plural, =0{ left} =1{ ago} other{}}',
                        $interval
                    );

                    if($interval->invert == 1)
                        $along = ' <small class="pull-right text-danger">[ ' . $along . ' ]</small>';
                    else
                        $along = ' <small class="pull-right text-success">[ ' . $along . ' ]</small>';

                    return \Yii::$app->formatter->asDatetime($data->created_at) . $along;
                }
            ],
            [
                'attribute' => 'updated_at',
                'format' => 'html',
                'value' => function($data) {

                    $datenow = new DateTime("now");
                    $updated = new DateTime($data->updated_at);
                    $interval = $datenow->diff($updated);

                    $along = Yii::t(
                        'app/modules/tasks',
                        '{y, plural, =0{} =1{# year} one{# year} few{# years} many{# years} other{# years}}{y, plural, =0{} =1{, } other{, }}{m, plural, =0{} =1{# month} one{# month} few{# months} many{# months} other{# months}}{m, plural, =0{} =1{, } other{, }}{d, plural, =0{} =1{# day} one{# day} few{# days} many{# days} other{# days}}{d, plural, =0{} =1{, } other{, }}{h, plural, =0{} =1{# hour} one{# hour} few{# hours} many{# hours} other{# hours}}{h, plural, =0{} =1{, } other{, }}{i, plural, =0{} =1{# minute} one{# minute} few{# minutes} many{# minutes} other{# minutes}}{i, plural, =0{} =1{, } other{, }}{s, plural, =0{} =1{# second} one{# second} few{# seconds} many{# seconds} other{# seconds}}{invert, plural, =0{ left} =1{ ago} other{}}',
                        $interval
                    );

                    if($interval->invert == 1)
                        $along = ' <small class="pull-right text-danger">[ ' . $along . ' ]</small>';
                    else
                        $along = ' <small class="pull-right text-success">[ ' . $along . ' ]</small>';

                    return \Yii::$app->formatter->asDatetime($data->updated_at) . $along;
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'html',
                'value' => function($data, $model) {

                    if ($data->status == wdmg\tasks\models\Tasks::TS_STATUS_WATING)
                        return '<span class="label label-default">'.Yii::t('app/modules/tasks','Wating').'</span>';
                    elseif ($data->status == wdmg\tasks\models\Tasks::TS_STATUS_PROGRESS)
                        return '<span class="label label-success">'.Yii::t('app/modules/tasks','Progress').'</span>';
                    elseif ($data->status == wdmg\tasks\models\Tasks::TS_STATUS_COMPLETE)
                        return '<b class="text-success">'.Yii::t('app/modules/tasks','Complete').'</b>';
                    elseif ($data->status == wdmg\tasks\models\Tasks::TS_STATUS_UNSUCCESS)
                        return '<span class="label label-danger">'.Yii::t('app/modules/tasks','Unsuccessfully').'</span>';
                    elseif ($data->status == wdmg\tasks\models\Tasks::TS_STATUS_SUSPENDED)
                        return '<span class="label label-warning">'.Yii::t('app/modules/tasks','Suspended').'</span>';
                    elseif ($data->status == wdmg\tasks\models\Tasks::TS_STATUS_CANCELED)
                        return '<b class="text-danger">'.Yii::t('app/modules/tasks','Canceled').'</b>';
                    else
                        return false;

                },
            ],
        ],
    ]) ?>

    <p>
        <?= Html::a(Yii::t('app/modules/tasks', '&larr; Back to list'), ['tasks/index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a(Yii::t('app/modules/tasks', 'Edit'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app/modules/tasks', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger pull-right',
            'data' => [
                'confirm' => Yii::t('app/modules/tasks', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>
