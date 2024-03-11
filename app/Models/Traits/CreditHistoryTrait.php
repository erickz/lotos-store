<?php

namespace App\Models\Traits;

use Carbon\Carbon;

trait CreditHistoryTrait
{
    public function getFormattedAmount()
    {
        return 'R$' . number_format($this->amount, 2, ',', '.');
    }

}