<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class COATemplate extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function samples()
    {
        return $this->belongsToMany(Sample::class, 'coa_template_samples', 'coa_temp_id', 'sample_id');
    }
}
