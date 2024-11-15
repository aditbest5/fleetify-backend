<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable, HasUuids;


    protected $primaryKey = 'id';

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>  
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id'
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (!$model->role_id) {
                if (auth()->check() && auth()->user()->isAdmin()) {
                    $model->role_id = $model->getRoleUser();
                } else {
                    $model->role_id = $model->getRoleAdmin();
                }
            }
        });
    }

    public function isAdmin()
    {
        if ($this->role) {
            if ($this->role->name == 'admin') {
                return true;
            }
        }
    }

    public function getRoleUser()
    {
        $role = Role::where('name', 'user')->first();
        return $role->id;
    }
    
    public function getRoleAdmin()
    {
        $role = Role::where('name', 'admin')->first();
        return $role->id;
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function employee()
    {
        $this->hasMany(Employee::class, 'user_id', 'id');
    }

}
