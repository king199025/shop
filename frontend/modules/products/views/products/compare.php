<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\basket\models\BasketSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сравнить';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="basket-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            [
                'attribute' => 'title',
                'format' => 'raw',
                'value' => function($model){
                    return Html::a($model->title, Url::toRoute(['view', 'id' => $model->id]));
                },
            ],
            [
                'attribute' => 'photo',
                'format' => 'raw',
                'value' => function ($model) {
                    return "<img src='$model->photo' width='200'/>";
                }
            ],
            [
                'attribute' => 'price',
            ],
            [
                'attribute' => 'weight',
            ],
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{myButton}',
                'buttons' => [
                    'myButton' => function ($url, $model, $key) {
                        return Html::a('Удалить', Url::toRoute(['/products/products/del-from-compare', 'product_id' => $model->id]));
                    }
                ]
            ]

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
