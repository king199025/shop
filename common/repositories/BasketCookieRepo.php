<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 28.10.19
 * Time: 21:26
 */

namespace common\repositories;


use common\interfaces\BasketRepo;
use Yii;
use yii\base\BaseObject;

class BasketCookieRepo extends BaseObject implements BasketRepo
{

    public $cookieName;

    public function add($prodId)
    {
        $cookieArr = [];
        $data = [
            'id' => $prodId,
            'count' => 1
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

    public function hasProd()
    {
        $cookies = Yii::$app->request->cookies;
        if ($cookies->has($this->cookieName)) {
            return json_decode($cookies->getValue($this->cookieName), true);
        }
        return [];
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

    public function clear()
    {
        $this->setCoookie('');
    }
}