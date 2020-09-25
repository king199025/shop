<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <div class="row">
        <div class="col-xs-12">
            <text>Статус</text>
            <?= Select2::widget(
                [
                    'model'=> $model,
                    'attribute' => 'status',
                    'data' => \common\models\Category::getStatusText(),
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
