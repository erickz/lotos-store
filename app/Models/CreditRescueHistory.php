<?php

namespace App\Models;

use App\Models\Traits\DateTrait;

class CreditRescueHistory extends BaseModel
{
    protected $table = 'credits_rescue_history';

    use DateTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'value', 'pix_key', 'finished'
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
}
