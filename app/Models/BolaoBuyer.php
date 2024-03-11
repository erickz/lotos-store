<?php

namespace App\Models;

use App\Models\Traits\DateTrait;

class BolaoBuyer extends BaseModel
{
    use DateTrait;

    protected $table = 'boloes_buyers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'parent_id', 'bolao_id', 'cotas', 'is_owner'
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
