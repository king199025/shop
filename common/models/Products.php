<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property string $title
 * @property string $descr
 * @property int $price
 * @property string $photo
 * @property int $weight
 * @property int $category_id
 * @property int $status
 *
 * @property OrderProduct[] $orderProducts
 * @property Category $category
 */
class Products extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DISABLED = 0;
    /**
     * @var UploadedFile
     */
    public $imageFile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['descr'], 'string'],
            [['price', 'weight', 'category_id', 'status'], 'integer'],
            [['title', 'photo'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
            'descr' => 'Описание',
            'price' => 'Цена',
            'photo' => 'Фото',
            'weight' => 'Вес',
            'category_id' => 'Категория',
            'status' => 'Статус',
            'imageFile' => 'Фото',
        ];
    }

    public static function getStatusText()
    {
        return [
            self::STATUS_ACTIVE => 'Активный',
            self::STATUS_DISABLED => 'Неактивный'
        ];
    }

    public static function getProductByCategory()
    {
        Products::findAll(['category_id' => Yii::$app->request->get('category_id')]);
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            $this->photo = '/secure/uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension;
            return true;
        } else {
            return false;
        }
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
}
