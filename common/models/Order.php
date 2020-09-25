<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\db\Expression;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property int $user_id
 * @property int $dt_add
 * @property int $status
 *
 * @property OrderProduct[] $orderProducts
 */
class Order extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DISABLED = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'dt_add', 'status'], 'integer'],
        ];
    }

    public function behaviors()
    {
        return
            [
                [
                    'class' => TimestampBehavior::className(),
                    'attributes' =>
                        [
                            ActiveRecord::EVENT_BEFORE_INSERT => ['dt_add'],
                        ]
                ]
            ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Номер заказа',
            'user_id' => 'Пользователь',
            'dt_add' => 'дата добавления',
            'status' => 'Статус',
        ];
    }

    public static function getStatusText()
    {
        return [
            self::STATUS_ACTIVE => 'Активный',
            self::STATUS_DISABLED => 'Неактивный'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderProducts()
    {
        return $this->hasMany(OrderProduct::className(), ['order_id' => 'id']);
    }

    public function getUserName()
    {
        return implode(ArrayHelper::getColumn($this->user_id, 'username'));
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
