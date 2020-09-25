<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\datetime\DateTimePicker;


/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-xs-12">
            <text>Пользователи</text>
            <?= Select2::widget(
                [
                    'model'=> $model,
                    'attribute' => 'user_id',
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\User::find()->all(), 'id', 'username'),
                    'options' => ['placeholder' => '...', 'class' => 'form-control', 'multiple' => false],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]
            ) ?>
        </div>
    </div>


    <div class="row">
        <div class="col-xs-12">
            <text>Статус</text>
            <?= Select2::widget(
                [
                    'model'=> $model,
                    'attribute' => 'status',
                    'data' => \common\models\Order::getStatusText(),
                    'options' => ['placeholder' => '...', 'class' => 'form-control', 'multiple' => false],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]
            ) ?>
        </div>
    </div>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
