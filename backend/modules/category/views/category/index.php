<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\modules\category\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <p>
        <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            [
                'attribute' => 'status',
                'value' => function (\common\models\Category $order) {
                    return \common\models\Category::getStatusText()[$order->status];
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
