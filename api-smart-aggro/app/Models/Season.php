<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Season extends Model
{
    protected $table = 'm_seasons';
    protected $fillable = ['name', 'start_date', 'end_date'];
    public $timestamps = false;

    public function plant_recommendations()
    {
        return $this->hasMany(PlantRecommendation::class);
    }
}
