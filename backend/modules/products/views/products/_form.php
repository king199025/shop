<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descr')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'imageFile')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
    ]); ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <div class="row">
        <div class="col-xs-12">
            <text>Категория</text>
            <?= Select2::widget(
                [
                    'model'=> $model,
                    'attribute' => 'category_id',
                    'data' => \yii\helpers\ArrayHelper::map(\common\models\Category::find()->all(), 'id', 'name'),
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
                    'data' =>
                        [
                            \common\models\Products::STATUS_ACTIVE => 'Активен',
                            \common\models\Products::STATUS_DISABLED => 'Неактивен',
                        ],
                    'options' => ['placeholder' => '...', 'class' => 'form-control', 'multiple' => false],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]
            ) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Cохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
