<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Land extends Model
{
    protected $guarded = [];

    public function farmer()
    {
        return $this->belongsTo(Farmer::class);
    }
}
