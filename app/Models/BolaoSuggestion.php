<?php

namespace App\Models;

use App\Models\Traits\DateTrait;
use App\Models\Traits\BolaoSuggestionTrait;
use Carbon\Carbon;

class BolaoSuggestion extends BaseModel
{
    use DateTrait, BolaoSuggestionTrait;

    protected $table = "boloes_suggestions";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'lotery_id', 'name', 'bets', 'qt_bets', 'price', 'price_cota', 'cotas', 'chances', 'receipt'
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
        return $this->belongsTo('App\Models\Lotery');
    }
}
