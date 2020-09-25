<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 28.10.19
 * Time: 23:20
 */
namespace common\interfaces;

Interface FavoriteRepo
{
    public function add($prodId);

    public function getList();

    public function remove($prodId);
}