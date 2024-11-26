<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Access extends Model
{
    protected $fillable = ['startChange', 'endChange','date','confirm','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
