<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trajectory extends Model
{
    protected $guarded = [];

    public function dataset()
    {
        return $this->belongsTo(AerialDataset::class, 'dataset_id');
    }
}
