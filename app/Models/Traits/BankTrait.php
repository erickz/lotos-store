<?php

namespace App\Models\Traits;

trait BankTrait
{
    public function getType()
    {
        return $this->type == 'cc' ? 'Conta Corrente' : 'Conta Poupança';
    }
}