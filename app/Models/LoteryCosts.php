<?php

namespace App\Models;

use App\Models\Traits\PriceTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoteryCosts extends BaseModel
{
    use SoftDeletes, PriceTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lotery_id', 'number_matches', 'prize', 'chances'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function lotery()
    {
        return $this->belongsTo('App\Models\Lotery');
    }
}
