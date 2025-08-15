<?php

namespace App\Models;

use App\Models\part_three\ResultItem;
use Illuminate\Database\Eloquent\Model;
use App\Models\first_part\TestMethodItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SampleTestMethodItem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function sample_test_method()
    {
        return $this->belongsTo(SampleTestMethod::class, 'sample_test_method_id');
    }
    public function test_method_item(){
        return $this->belongsTo(TestMethodItem::class, 'test_method_item_id');
    }

    // public function results_for_item(){
    //     return $this->hasMany(ResultItem::class , '');
    // }
}
