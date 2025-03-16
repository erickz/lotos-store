<?php

namespace App\Models;

use App\Models\Traits\DateTrait;

class PaymentQrCode extends BaseModel
{
    use DateTrait;

    protected $table = 'payments_qr_code';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'payment_id', 'source_id', 'expiration_date', 'amount', 'codeText', 'imageLink'
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

    public function payment()
    {
        return $this->belongsTo('App\Models\payment');
    }

    public function getExpirationDate(){
        $expirationDatetime = \Carbon\Carbon::createFromDate($this->expiration_date);
        return $expirationDatetime->format('d/m/Y H:i:s');
    }
}
