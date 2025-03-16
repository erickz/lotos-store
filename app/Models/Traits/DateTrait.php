<?php

namespace App\Models\Traits;

use Carbon\Carbon;

trait DateTrait
{
    public function getCreatedAtFormatted($dateOnly = true)
    {
        $format = 'd/m/Y';

        if (! $dateOnly){
            $format = 'd/m/Y H\hi';
        }

        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format($format);
    }

    public function getUpdatedAtFormatted($dateOnly = true)
    {
        $format = 'd/m/Y';

        if (! $dateOnly){
            $format = 'd/m/Y H\hi';
        }

        return Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->format($format);
    }

    public function getCreatedAgo(){
        return $this->created_at->diffForHumans(null, true);
    }
}