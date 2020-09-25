<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Basket */

$this->title = 'Update Basket: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Baskets', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="basket-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
