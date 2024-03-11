<?php

namespace App\Models;

use App\Models\Traits\DateTrait;
use App\Models\Traits\BolaoTrait;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bolao extends BaseModel
{
    use DateTrait, BolaoTrait, SoftDeletes;

    protected $table = 'boloes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lotery_id', 'customer_id', 'chances', 'concurso_id', 'active', 'display_for_selling', 'featured', 'name', 'cotas', 'cotas_available', 'price', 'prize', 'description', 'quantity_games', 'visits', 'total_value'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    protected $casts = [
        'active', 'featured'
    ];

    public function concurso()
    {
        return $this->belongsTo('App\Models\Concurso');
    }

    public function lotery()
    {
        return $this->belongsTo('App\Models\Lotery');
    }

    public function games()
    {
        return $this->hasMany('App\Models\BolaoGame');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

    public function buyers()
    {
        return $this->hasMany('App\Models\BolaoBuyer');
    }

    public function reserves()
    {
        return $this->hasMany('App\Models\BolaoReserve', 'bolao_id');
    }

    public function invites()
    {
        return $this->hasMany('App\Models\BolaoInvite', 'bolao_id');
    }
}
