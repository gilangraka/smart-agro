<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Season extends Model
{
    use hasfactory;
    protected $table = 'm_seasons';
    protected $fillable = ['name', 'start_date', 'end_date'];

    public function plant_recommendations()
    {
        return $this->hasMany(PlantRecommendation::class);
    }
}
