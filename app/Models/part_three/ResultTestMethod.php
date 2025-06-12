<?php

namespace App\Models\part_three;

use App\Models\first_part\TestMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ResultTestMethod extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function result()
    {
        return $this->belongsTo(Result::class, 'result_id');
    }
    public function test_method(){
        return $this->belongsTo(TestMethod::class, 'test_method_id');
    }
    public function result_test_method_items()
    {
        return $this->hasMany(ResultTestMethodItem::class, 'result_test_method_id', 'id');
    }
}
