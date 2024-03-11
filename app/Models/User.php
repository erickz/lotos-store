<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Notifications\ResetPasswordCustomNotification;
use App\Notifications\VerifyEmailNotification;

use Laratrust\Traits\LaratrustUserTrait;

use Illuminate\Support\Facades\Hash;

use App\Models\Traits\UserTrait;
use App\Models\Traits\DateTrait;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use LaratrustUserTrait;
    use Notifiable, SoftDeletes, CanResetPassword;
    use DateTrait, UserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'active', 'name', 'email', 'password',
    ];

    protected $guard = "adm";

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'active' => 'boolean'
        ,'email_verified_at' => 'datetime'
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordCustomNotification($token));
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new VerifyEmailNotification());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|void
     */
    public function creditsHistory()
    {
        return $this->hasMany('App\Models\CreditHistory');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function store()
    {
        return $this->belongsTo('App\Models\Store');
    }
}
