<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 28.10.19
 * Time: 23:19
 */

namespace common\components;


use common\interfaces\FavoriteRepo;
use common\repositories\FavoriteCookieRepo;
use common\repositories\FavoriteDBRepo;
use yii\base\Component;

class FavoriteCG extends Component
{

    public $type = 'cookie';
    public $cookieName = 'favoriteCG';

    /**
     * @var $repo FavoriteRepo
     */
    public $repo;

    public function init()
    {
        parent::init();

        switch ($this->type) {
            case 'cookie':
                $this->repo = new FavoriteCookieRepo();
                $this->repo->cookieName = $this->cookieName;
                break;
            case 'db':
                $this->repo = new FavoriteDBRepo();
                break;
            default:
                $this->repo = new FavoriteCookieRepo();
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

}