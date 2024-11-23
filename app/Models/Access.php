<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    protected $fillable = ['startChange', 'endChange'];

    public function users(){
        return $this->hasMany(User::class);
    }
}
