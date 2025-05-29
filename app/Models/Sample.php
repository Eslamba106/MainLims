<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
  public function sample_name()
    {
        return $this->belongsTo(SamplePlant::class, 'plant_sample_id', 'id');
    }
    // public function sample_name()
    // {
    //     return $this->hasOne(SamplePlant::class ,'id', 'plant_sample_id');
    // }
    public function plant_main()
    {
        return $this->hasOne(Plant::class ,'id', 'plant_id');
    }
    public function sub_plant ()
    {
        return $this->hasOne(Plant::class ,'id', 'sub_plant_id');
    }
    public function test_methods()
    {
        return $this->hasMany(SampleTestMethod::class ,'sample_id', 'id');
    }
}
