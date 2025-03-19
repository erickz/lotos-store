<?php

namespace App\Models\Traits;

trait BolaoReserveTrait
{
    protected $timelimitCart = 15; 

    public static function boot()
    {
        parent::boot();

        static::saving(function($item) {
            $item->expiration_date = \Carbon\Carbon::now()->addMinutes(15)->format('Y-m-d H:i:s');
        });
    }

    public function scopeIsActive($query)
    {
        return $query->where('expiration_date', '>', \Carbon\Carbon::now()->format('Y-m-d H:i:s'))->where('processed', 0);
    }

    //The reserve is used for the cart and has a timelimit of 15minutes, after that the bolao has to be selected again if desired
    public function isReserveActive()
    {
        $now = \Carbon\Carbon::now()->format('Y-m-d H:i:s');

        return $this->expiration_date > $now && $this->processed == 0 && $this->bolao->cotas_available > 0 ? true : false;
    }

    public function getExpirationDateFormatted()
    {
        $format = 'd/m/Y H\hi';

        return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->expiration_date)->format($format);
    }
}