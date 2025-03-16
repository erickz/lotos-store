<?php

namespace App\Models;

use App\Models\Traits\DateTrait;
use App\Models\Traits\PaymentTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends BaseModel
{
    use DateTrait, PaymentTrait, SoftDeletes;

    protected $table = 'payments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'transaction_id', 'email', 'name', 'completed', 'gateway', 'type', 'status', 'code', 'total', 'url'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    protected $casts = [
        'type', 'completed'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function qrCode()
    {
        return $this->hasOne('App\Models\PaymentQrCode');
    }
}
