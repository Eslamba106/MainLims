<?php

namespace App\Models\first_part;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestMethod extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function test_method_items(){
        return $this->hasMany(TestMethodItem::class, 'test_method_id', 'id');
    }
    public function test_method_items_count(){
        return $this->hasMany(TestMethodItem::class, 'test_method_id', 'id')->count();
    }
}
