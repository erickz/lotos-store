<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait UuidTrait
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            $post->{$post->getKeyName()} = (string) Str::uuid();
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }

    function gmp_base_convert(string $value, int $initialBase, int $newBase)
    {
        return gmp_strval(gmp_init($value, $initialBase), $newBase);
    }

    public function encode()
    {
        return base_convert($this->id, 16, 36);
    }

    public static function decode(string $hashid)
    {

    }
}