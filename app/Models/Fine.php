<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fine extends Model
{
    protected $fillable = ['description'];
    public function users(){
        return $this->hasMany(User::class);
    }
}
