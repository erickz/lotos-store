<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;


trait StoreTrait
{
    public static function boot()
    {
        parent::boot();

        static::creating(function($item) {
            $item->generateAlias();
        });

        static::saved(function($item){
            $item->generateToken();
            $item->save();
        });
    }

    /**
     *
     */
    public function generateAlias()
    {
        $this->alias = Str::snake($this->name);
    }

    public function generateToken()
    {
        $token = auth('api')->tokenById($this->id);
        $this->api_token = $token;
    }
}