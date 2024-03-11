<?php

namespace App\Models;

use App\Models\Traits\DateTrait;
use App\Models\Traits\CreditHistoryTrait;

class CreditHistory extends BaseModel
{
    protected $table = 'credits_history';

    use DateTrait, CreditHistoryTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'amount', 'type'
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
