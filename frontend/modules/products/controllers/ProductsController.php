<?php

namespace app\modules\products\controllers;

use Yii;
use common\models\Products;
use app\modules\products\models\ProductsSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
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
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
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
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Products model.
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
     * Deletes an existing Products model.
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

    public function actionCompare()
    {
        $products = Yii::$app->compareCG->getList();
        $ids = [];
        foreach ($products as $product) {
            $ids[] = $product['id'];
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Products::find()->where(['id' => $ids]),
        ]);

        return $this->render('compare', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAddToCompare()
    {
        $product_id = Yii::$app->request->get('product_id');
        Yii::$app->compareCG->add($product_id);

        Yii::$app->session->setFlash('success', 'Товар добавлен к сравнению');
        return $this->redirect('/products/products');
    }

    public function actionDelFromCompare()
    {
        $product_id = Yii::$app->request->get('product_id');
        Yii::$app->compareCG->remove($product_id);

        Yii::$app->session->setFlash('success', 'Товар удален из сравнения');
        return $this->redirect('/products/products');
    }


    public function actionFavorite()
    {
        $products = Yii::$app->favoriteCG->getList();
        $ids = [];
        foreach ($products as $product) {
            $ids[] = $product['id'];
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Products::find()->where(['id' => $ids]),
        ]);

        return $this->render('favorite', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionAddToFavorite()
    {
        $product_id = Yii::$app->request->get('product_id');
        Yii::$app->favoriteCG->add($product_id);

        Yii::$app->session->setFlash('success', 'Товар добавлен в избранное');
        return $this->redirect('/products/products');
    }

    public function actionDelFromFavorite()
    {
        $product_id = Yii::$app->request->get('product_id');
        Yii::$app->favoriteCG->remove($product_id);

        Yii::$app->session->setFlash('success', 'Товар удален из избранного');
        return $this->redirect('/products/products');
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
