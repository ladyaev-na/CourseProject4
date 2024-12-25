<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    protected $fillable = ['title', 'description','price'];
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
