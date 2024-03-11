<?php

namespace App\Models;

use App\Models\Traits\DateTrait;
use App\Models\Traits\LoteryTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lotery extends BaseModel
{
    use DateTrait, LoteryTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id', 'active', 'initials', 'name', 'biggest_number', 'description'
        ,'draw_days', 'number_boloes_by_payslip', 'min_numbers', 'max_numbers', 'min_matches'
        ,'max_matches', 'description', 'description2', 'description_stats'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    protected $casts = [
        'active', 'build_boloes'
    ];

    public function costs()
    {
        return $this->hasMany('App\Models\LoteryCosts');
    }

    public function concursos()
    {
        return $this->hasMany('App\Models\Concurso');
    }

    public function stats()
    {
        return $this->hasMany('App\Models\LoteryStats');
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function scopeByInitials($query, $initials = '')
    {
        return $query->where('initials', $initials);
    }
}
