<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\basket\models\BasketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Корзина';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="basket-index">
    <?php if (Yii::$app->user->isGuest): ?>
        <p>Авторизируйтесь чтобы сделать заказ</p>
    <?php elseif (!Yii::$app->basketCG->hasProd()): ?>
        <p>Корзина пуста</p>
        <p>
            <?= Html::a('Выбрать товар', ['/products/products'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php else: ?>
        <p>
            <?= Html::a('Сделать заказ', ['create-order'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php endif; ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            [
                'attribute' => 'title',
            ],
            [
                'attribute' => 'photo',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{myButton}',
                'buttons' => [
                    'myButton' => function ($url, $model, $key) {
                        return Html::a('Удалить', Url::toRoute(['/basket/basket/del', 'product_id' => $model->id]));
                    }
                ]
            ]

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
