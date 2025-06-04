<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SamplePlant extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'plant_samples';
    public function sample()
    {
        return $this->belongsTo(Sample::class, 'plant_sample_id', 'id');
    }
    // public function sample()
    // {
    //     return $this->hasOne(Sample::class, 'plant_sample_id', 'id');
    // }
    public function mainPlant()
    {
        return $this->belongsTo(Plant::class, 'plant_id', 'id');
    }


    protected $appends = ['main_plant_name'];

    public function getMainPlantNameAttribute()
    {
        return $this->mainPlant?->name;
    }
    // protected $appends = ['test_methods'];

    // public function getTestMethodsAttribute()
    // {
    //     return $this->mainPlant?->name;
    // }
}
