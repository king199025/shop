<?php

namespace app\modules\basket\controllers;

use common\models\Order;
use common\models\OrderProduct;
use common\models\Products;
use Yii;
use common\models\Basket;
use app\modules\basket\models\BasketSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

/**
 * BasketController implements the CRUD actions for Basket model.
 */
class BasketController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Basket models.
     * @return mixed
     */
    public function actionIndex()
    {
        $products = Yii::$app->basketCG->getList();
        $ids = [];
        foreach ($products as $product) {
            $ids[] = $product['id'];
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Products::find()->where(['id' => $ids]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Basket model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Basket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Basket();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Basket model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Basket model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Basket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Basket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Basket::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionSave()
    {
        $product_id = Yii::$app->request->get('product_id');
        Yii::$app->basketCG->add($product_id);

        Yii::$app->session->setFlash('success', 'Товар добавлен в корзину');
        return $this->redirect('/products/products');
    }

    public function actionDel()
    {
        $product_id = Yii::$app->request->get('product_id');
        Yii::$app->basketCG->remove($product_id);

        Yii::$app->session->setFlash('success', 'Товар удален из корзины');
        return $this->redirect('/basket/basket');
    }

    public function actionCreateOrder()
    {
        $order = new Order();
        $order->user_id = Yii::$app->user->id;
        $order->status = Order::STATUS_ACTIVE;
        $order->save();

        $products = Yii::$app->basketCG->getList();
        foreach ($products as $product){
            $item = new OrderProduct();
            $item->product_id = $product['id'];
            $item->order_id = $order->id;
            $item->save();
        }
        Yii::$app->basketCG->clear();

        return $this->redirect('/order/order');
    }
}
