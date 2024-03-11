<?php

namespace App\Models\Traits;

trait PriceTrait
{

    public function getPrice($column = 'price')
    {
        return 'R$' . number_format($this->{$column}, 2, ',', '.');
    }

}