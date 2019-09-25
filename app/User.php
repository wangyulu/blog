<?php

namespace App;

use Faker\Generator;
use App\Models\Scopes\EmailScope;
use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'ticket', 'remember_token'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    public static function boot()
    {
        parent::boot();

        self::addGlobalScope(new EmailScope());
    }

    public function scopeName(Builder $builder, ...$params)
    {
        \Log::info(__CLASS__, [$builder, $params]);
    }

    public function getNameAttribute($value)
    {
        return $value . '___xx';
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = app()->make(Generator::class)->name;
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = app()->make(Generator::class)->email;
    }

    public function roles()
    {
        $this->hasMany();
    }
}
