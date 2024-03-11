<?php

namespace App\Models;

use App\Models\Traits\DateTrait;
use App\Models\Traits\BolaoGameTrait;

class BolaoGame extends BaseModel
{
    use DateTrait, BolaoGameTrait;

    protected $table = 'boloes_games';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bolao_id', 'checked', 'prized', 'number_match', 'quantity_numbers', 'numbers'
    ];

    protected $casts = [
        'checked', 'prized'
    ];

    public function bolao()
    {
        return $this->belongsTo('App\Models\Bolao');
    }
}
