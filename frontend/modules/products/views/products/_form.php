<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descr')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'photo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weight')->textInput() ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
