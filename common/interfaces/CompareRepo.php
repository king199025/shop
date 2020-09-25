<?php

/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 28.10.19
 * Time: 22:50
 */

namespace common\interfaces;

interface CompareRepo
{
    public function add($prodId);

    public function getList();

    public function remove($prodId);
}