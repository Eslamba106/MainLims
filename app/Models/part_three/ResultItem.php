<?php

namespace App\Models\part_three;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResultItem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $table = 'result_test_method_items';
    public function result()
    {
        return $this->belongsTo(Result::class, 'result_id');
    }
  
    
}
