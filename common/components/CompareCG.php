<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 28.10.19
 * Time: 22:48
 */

namespace common\components;


use common\interfaces\CompareRepo;
use common\repositories\CompareCookieRepo;
use common\repositories\CompareDBRepo;
use yii\base\Component;

class CompareCG extends Component
{

    public $type = 'cookie';
    public $cookieName = 'compareCG';

    /**
     * @var $repo CompareRepo
     */
    public $repo;

    public function init()
    {
        parent::init();

        switch ($this->type) {
            case 'cookie':
                $this->repo = new CompareCookieRepo();
                $this->repo->cookieName = $this->cookieName;
                break;
            case 'db':
                $this->repo = new CompareDBRepo();
                break;
            default:
                $this->repo = new CompareCookieRepo();
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