<?php

namespace App\Models;

use App\Models\Traits\DateTrait;
use App\Models\Traits\BolaoReserveTrait;

class BolaoReserve extends BaseModel
{
    use DateTrait, BolaoReserveTrait;

    protected $table = 'boloes_reserves';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'bolao_id', 'cotas', 'processed', 'expiration_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    protected $casts = [
        
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function bolao()
    {
        return $this->belongsTo('App\Models\Bolao');
    }
}
