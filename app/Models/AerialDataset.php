<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AerialDataset extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function trajectories()
    {
        return $this->hasMany(Trajectory::class, 'dataset_id');
    }

    public function clusters()
    {
        return $this->hasMany(Cluster::class, 'dataset_id');
    }
}
