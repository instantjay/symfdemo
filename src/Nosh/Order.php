<?php

namespace App\Nosh;

class Order
{
    public function load($param)
    {
        $this->id = $param['id'];
    }

    protected $id;

    public function getId()
    {
        return $this->id;
    }
}