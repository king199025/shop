<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 28.10.19
 * Time: 20:57
 */

namespace common\components;


use common\interfaces\BasketRepo;
use common\repositories\BasketCookieRepo;
use common\repositories\BasketDBRepo;
use yii\base\BaseObject;
use yii\base\Component;

class BasketCG extends Component
{

    public $type = 'cookie';
    public $cookieName = 'basketCG';

    /**
     * @var $repo BasketRepo
     */
    public $repo;

    public function init()
    {
        parent::init();

        switch ($this->type) {
            case 'cookie':
                $this->repo = new BasketCookieRepo();
                $this->repo->cookieName = $this->cookieName;
                break;
            case 'db':
                $this->repo = new BasketDBRepo();
                break;
            default:
                $this->repo = new BasketCookieRepo();
                $this->repo->cookieName = $this->cookieName;

        }
    }


    public function add($prodId)
    {
        $this->repo->add($prodId);
    }

    public function getList()
    {
        return $this->repo->getList();
    }

    public function remove($prodId)
    {
        return $this->repo->remove($prodId);
    }

    public function hasProd()
    {
        return $this->repo->hasProd();
    }

    public function clear()
    {
        $this->repo->clear();
    }

}