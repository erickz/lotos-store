<?php

namespace App\Models;

use App\Models\Traits\DateTrait;

class Reward extends BaseModel
{
    use DateTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'bolao_id', 'prize', 'cotas', 'prize_per_cota'
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
