<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\order\models\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Заказы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <p>
        <?= Html::a('Создать заказ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'dt_add:date',
            [
                'attribute' => 'status',
                'value' => function (\common\models\Order $order) {
                    return \common\models\Order::getStatusText()[$order->status];
                }
            ],
            [
                'attribute' => 'user.username',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
