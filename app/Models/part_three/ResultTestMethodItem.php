<?php

namespace App\Models\part_three;

use App\Models\first_part\TestMethodItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultTestMethodItem extends Model
{
    use HasFactory;

    protected $guarded =[];
    

    public function main_result(){
        return $this->belongsTo(Result::class, 'result_id');
    }
    public function main_result_test_method(){
        return $this->belongsTo(ResultTestMethod::class, 'result_test_method_id');
    }
    public function main_test_method_item(){
        return $this->belongsTo(TestMethodItem::class, 'test_method_item_id');
    }

}
