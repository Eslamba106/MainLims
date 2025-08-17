<?php
namespace App\Models\second_part;

use App\Models\part_three\ResultItem;
use App\Models\SampleTestMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubmissionItem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function submission()
    {
        return $this->belongsToMany(Submission::class, 'submission_id');
    }
    public function sample_test_method()
    {
        return $this->belongsTo(SampleTestMethod::class, 'sample_test_method_item_id');
    }

    public function result()
    {
        return $this->hasOne(ResultItem::class, 'submission_item', 'id');
    }
}
