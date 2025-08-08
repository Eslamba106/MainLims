<?php

namespace App\Models\second_part;

use App\Models\Plant;
use App\Models\Sample;
use App\Models\SamplePlant;
use App\Models\SampleTestMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\part_three\Result;


class Submission extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public function plant()
    {
        return $this->belongsTo(Plant::class , 'plant_id');
    }
    public function sub_plant()
    {
        return $this->belongsTo(Plant::class, 'sub_plant_id');
    }
    public function sample_main()
    {
        return $this->belongsTo(SamplePlant::class, 'plant_sample_id');
    }
    public function sample()
    {
        return $this->belongsTo(Sample::class, 'sample_id');
    }
    public function master_sample()
    {
        return $this->belongsTo(Sample::class, 'sample_id');
    }
    public function new_sample_main()
    {
        return $this->belongsTo(SamplePlant::class, 'plant_sample_id');
    }
    public function submission_test_method_items()
    {
        return $this->hasMany(SubmissionItem::class, 'submission_id' , 'id');
    }
    public function result()
    {
        return $this->hasMany(Result::class, 'submission_id' , 'id');
    }
}
