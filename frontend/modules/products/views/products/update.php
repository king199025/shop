<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Products */

$this->title = 'Update Products: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="products-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
