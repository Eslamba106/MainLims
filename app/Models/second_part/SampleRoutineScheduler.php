<?php
namespace App\Models\second_part;

use App\Models\Plant;
use App\Models\Sample;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampleRoutineScheduler extends Model
{
    use HasFactory;
    protected $guarded    = ['id'];
    protected $connection = 'tenant';

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
    public function frequency()
    {
        return $this->belongsTo(Frequency::class, 'frequency_id', 'id');
    }
    public function sample_routine_scheduler_items()
    {
        return $this->hasMany(SampleRoutineSchedulerItem::class, 'sample_scheduler_id', 'id');
    }
}
