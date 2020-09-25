<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\modules\order\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [

            'id',
            'dt_add:date',
            [
                'attribute' => 'status',
                'value' => function (\common\models\Order $order) {
                    return \common\models\Order::getStatusText()[$order->status];
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
