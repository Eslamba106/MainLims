<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SamplePlant extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'plant_samples';
    public function mainPlant()
    {
        return $this->belongsTo(SamplePlant::class, 'plant_id');
    }
}
