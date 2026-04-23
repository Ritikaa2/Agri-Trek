<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Farmer extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lands()
    {
        return $this->hasMany(Land::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}
