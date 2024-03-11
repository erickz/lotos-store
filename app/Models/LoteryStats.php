<?php

namespace App\Models;

use App\Models\Traits\DateTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoteryStats extends BaseModel
{
    use DateTrait;

    protected $table = "loteries_stats";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lotery_id', 'number_dozens', 'odds'
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

    public function lotery()
    {
        return $this->hasMany('App\Models\Lotery');
    }
}
