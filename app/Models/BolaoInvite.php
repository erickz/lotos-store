<?php

namespace App\Models;

use App\Models\Traits\DateTrait;

class BolaoInvite extends BaseModel
{
    use DateTrait;

    protected $table = 'boloes_invites';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bolao_id', 'owner_id', 'customer_id', 'expire_at', 'email', 'claimed', 'token', 'cotas'
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

    public function owner()
    {
        return $this->belongsTo('App\Models\Customer', 'owner_id');
    }

    public function bolao()
    {
        return $this->belongsTo('App\Models\Bolao');
    }
}
