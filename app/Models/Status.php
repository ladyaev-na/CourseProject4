<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['name', 'code'];
    public function users(){
        return $this->hasMany(User::class);
    }
}
