<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Order */
/* @var $prodDataProvider \yii\data\ActiveDataProvider */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Заказы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="order-view">

    <p>
        <?= Html::a('Список', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'dt_add:date',
            [
                'attribute' => 'status',
                'value' => function (\common\models\Order $order) {
                    return \common\models\Order::getStatusText()[$order->status];
                }
            ],
        ],
    ]) ?>

    <?= GridView::widget([
        'dataProvider' => $prodDataProvider,
        'columns' => [

            [
                'attribute' => 'product.title',
            ],
            [
                'attribute' => 'product.photo',
            ],
            [
                'attribute' => 'product.price',
            ],
            [
                'attribute' => 'product.weight',
            ],

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
