<?php

namespace App\Entities;

class Project
{
    /**
     * @return \Closure
     */
    public function getRoundingStrategy()
    {
        return function ($value) {
            return ceil($value);
        };
    }

    public function getPreferredDecimals()
    {
        return 1;
    }
}
