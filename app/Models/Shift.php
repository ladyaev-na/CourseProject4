<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    protected $fillable = ['estimation', 'order','access_id'];

    public function users(){
        return $this->hasMany(User::class);
    }
}
