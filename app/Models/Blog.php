<?php

namespace App\Models;

use App\Models\Traits\DateTrait;
use App\Models\Traits\BolaoGameTrait;

use Illuminate\Support\Str;

class Blog extends BaseModel
{
    use DateTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'active', 'concurso_id', 'title', 'slug', 'description', 'tags', 'meta_title', 'meta_description'
    ];

    protected $casts = [
        
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function($item) {
            $item->slug = Str::slug($item->title);
        });
    }

    public function concurso()
    {
        return $this->belongsTo('App\Models\Concurso');
    }
}
