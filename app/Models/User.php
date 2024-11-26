<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'surname','name','patronymic','login','password','api_token','role_id'
    ];


    protected $hidden = [
        'password',
        'api_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function fines()
    {
        return $this->hasMany(Fine::class);
    }
    public function access()
    {
        return $this->belongsTo(Access::class);
    }
    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
