<?php

namespace App\Models\first_part;

use App\Models\part\Unit;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestMethodItem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $connection = 'tenant';

    public function test_method()
    {
        return $this->belongsTo(TestMethod::class, 'test_method_id', 'id');
    }
    public function main_unit()
    {
        return $this->belongsTo(Unit::class, 'unit');
    }

}
