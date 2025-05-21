<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function sub_plants()
    {
        return $this->hasMany(Plant::class, 'plant_id');
    }
    public function mainPlant()
    {
        return $this->belongsTo(Plant::class, 'plant_id');
    }
    public function samplePlants()
    {
        return $this->hasMany(SamplePlant::class, 'plant_id');
    }
   

}
