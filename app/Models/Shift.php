<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = ['estimation', 'order'];

    public function users(){
        return $this->hasMany(User::class);
    }
}
