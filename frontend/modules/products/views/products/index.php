<?php

use common\models\Basket;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\products\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Товары';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->title, Url::toRoute(['view', 'id' => $model->id]));
                },
            ],

            //'title',
            //'descr:ntext',
            'price',
            [
                'attribute' => 'photo',
                'format' => 'raw',
                'value' => function ($model) {
                    return "<img src='$model->photo' width='200'/>";
                }
            ],
            //'weight',
            ['attribute' => 'category.name'],
            [
                'attribute' => 'status',
                'value' => function (\common\models\Products $products) {
                    return \common\models\Order::getStatusText()[$products->status];
                }
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{myButton}',
                'buttons' => [
                    'myButton' => function ($url, $model, $key) {
                        return Html::a('В корзину', Url::toRoute(['/basket/basket/save', 'product_id' => $model->id]));
                    }
                ]
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{myButton}',
                'buttons' => [
                    'myButton' => function ($url, $model, $key) {
                        return Html::a('Добавить к сравнению', Url::toRoute(['/products/products/add-to-compare', 'product_id' => $model->id]));
                    }
                ],
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{myButton}',
                'buttons' => [
                    'myButton' => function ($url, $model, $key) {
                        return Html::a('В избранное', Url::toRoute(['/products/products/add-to-favorite', 'product_id' => $model->id]));
                    }
                ],
            ]
        ],
    ]); ?>


</div>
