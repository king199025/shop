<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 28.10.19
 * Time: 21:35
 */

namespace common\interfaces;

Interface BasketRepo
{
    public function add($prodId);

    public function getList();

    public function remove($prodId);

    public function hasProd();

    public function clear();
}