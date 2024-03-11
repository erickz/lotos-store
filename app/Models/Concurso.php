<?php

namespace App\Models;

use App\Models\Traits\ConcursoTrait;
use App\Models\Traits\DateTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Concurso extends BaseModel
{
    use DateTrait, ConcursoTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'store_id', 'lotery_id', 'active', 'type', 'number', 'draw_day', 'draw_datetime', 'draw_numbers', 'draw_numbers_2',
        'value_accumulated', 'expected_prize', 'next_expected_prize', 'results', 'results_2'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    protected $casts = [
        'active', 'type'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lotery()
    {
        return $this->belongsTo('App\Models\Lotery');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function boloes()
    {
        return $this->hasMany('App\Models\Bolao');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function posts()
    {
        return $this->hasMany('App\Models\Blog');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }
}
