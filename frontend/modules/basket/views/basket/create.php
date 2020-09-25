<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Basket */

$this->title = 'Create Basket';
$this->params['breadcrumbs'][] = ['label' => 'Baskets', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="basket-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
