<?php

namespace App\Models\first_part;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestMethodItem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function test_method(){
        return $this->belongsTo(TestMethod::class, 'test_method_id', 'id');
    }
}
