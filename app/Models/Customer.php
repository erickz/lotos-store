<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Notifications\ResetPasswordCustomNotification;
use App\Notifications\VerifyEmailNotification;

use Illuminate\Support\Facades\Hash;

use App\Models\Traits\UserTrait;
use App\Models\Traits\DateTrait;
use App\Models\Traits\CustomerTrait;

class Customer extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, SoftDeletes, CanResetPassword;
    use CustomerTrait, DateTrait, UserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'active', 'newsletter', 'genre', 'full_name', 'birthday_date', 'cpf', 'cnpj', 'phone', 'email', 'password',
    ];

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
        ,'newsletter' => 'boolean'
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

    public function getJWTIdentifier() {
        return $this->getKey();
    }

    public function getJWTCustomClaims() {
        return [];
    }

    /**
     * Encrypt the user`s password
     * @param String $value
     * @return void
     */
    public function setPasswordAttribute($value)
    {
        if ($value){
            $this->attributes['password'] = Hash::make($value);
        }
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|void
     */
    public function bankAccounts()
    {
        return $this->hasMany('App\Models\CustomerBank');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|void
     */
    public function boloes()
    {
        return $this->hasMany('App\Models\Bolao');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|void
     */
    public function creditsHistory()
    {
        return $this->hasMany('App\Models\CreditHistory');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|void
     */
    public function creditsRescueHistory()
    {
        return $this->hasMany('App\Models\CreditRescueHistory');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|void
     */
    public function boloesBuyer()
    {
        return $this->hasMany('App\Models\BolaoBuyer');
    }
}
