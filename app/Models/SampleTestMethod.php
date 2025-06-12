<?php

namespace App\Models;

use App\Models\first_part\TestMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SampleTestMethod extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function master_test_method()
    {
        return $this->hasOne(TestMethod::class, 'id', 'test_method_id');
        // return $this->belongsTo(TestMethod::class);
    }
    public function sample_test_method_items()
    {
        return $this->hasMany(SampleTestMethodItem::class, 'test_method_id', 'id');
    }
}
