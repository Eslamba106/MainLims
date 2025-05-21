<?php

namespace App\Models\part;

use Illuminate\Database\Eloquent\Model;
use App\Models\first_part\TestMethodItem;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Unit extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // protected $connection = 'tenant';
    public function test_method_items()
    {
        return $this->hasMany(TestMethodItem::class, 'unit', 'id');
    }

}
