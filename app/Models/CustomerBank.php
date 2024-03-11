<?php

namespace App\Models;

use App\Models\Traits\BankTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerBank extends BaseModel
{
    use BankTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'bearer', 'agency', 'bank', 'type', 'code_bank', 'account_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function customer()
    {
        return $this->belongsTo('Customer');
    }
}
