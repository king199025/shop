<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 28.10.19
 * Time: 23:21
 */

namespace common\repositories;


use common\interfaces\FavoriteRepo;
use Yii;
use yii\base\BaseObject;

class FavoriteCookieRepo extends BaseObject implements FavoriteRepo
{

    public $cookieName;

    public function add($prodId)
    {
        $cookieArr = [];
        $data = [
            'id' => $prodId,
        ];
        $cookies = Yii::$app->request->cookies;
        if (isset(Yii::$app->request->cookies[$this->cookieName])) {
            $cookieArr = json_decode($cookies->getValue($this->cookieName), true);
        }
        $cookieArr[] = $data;
        $result = json_encode($cookieArr);

        $this->setCoookie($result);
    }

    public function getList()
    {
        return $this->getCookie();
    }

    public function remove($prodId)
    {
        $cookieArr = $this->getCookie();
        foreach ((array)$cookieArr as $k => $item) {
            if ($item['id'] == $prodId) {
                unset($cookieArr[$k]);
            }
        }
        $result = json_encode($cookieArr);

        $this->setCoookie($result);
    }

    private function getCookie()
    {
        $cookies = Yii::$app->request->cookies;
        if (isset(Yii::$app->request->cookies[$this->cookieName])) {
            return json_decode($cookies->getValue($this->cookieName), true);
        }
        return [];
    }

    private function setCoookie($result)
    {
        Yii::$app->getResponse()->getCookies()->add(new \yii\web\Cookie([
            'name' => $this->cookieName,
            'value' => $result,
            'expire' => time() + 86400 * 365,
            'path' => '/'

        ]));
    }
}