<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlantRecommendation extends Model
{
    protected $table = 'plant_recommendations';
    protected $fillable = ['name', 'season_id', 'imageUrl'];
    public $timestamps = false;

    public function season()
    {
        return $this->belongsTo(Season::class);
    }
}
