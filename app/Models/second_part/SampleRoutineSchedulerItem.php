<?php

namespace App\Models\second_part;

use App\Models\first_part\TestMethod;
use App\Models\Plant;
use App\Models\Sample;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SampleRoutineSchedulerItem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function sample_routine_scheduler()
    {
        return $this->belongsTo(SampleRoutineScheduler::class, 'sample_scheduler_id', 'id');
    }
    public function sample()
    {
        return $this->belongsTo(Sample::class, 'sample_id', 'id');
    }
    public function plant()
    {
        return $this->belongsTo(Plant::class, 'plant_id', 'id');
    }
    public function sub_plant()
    {
        return $this->belongsTo(Plant::class, 'sub_plant_id', 'id');    
    }

    public function test_method(){
        return $this->belongsTo(TestMethod::class ,'test_method_ids');
    }
}
