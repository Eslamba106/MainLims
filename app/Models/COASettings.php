<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class COASettings extends Model
{
    use HasFactory;
       protected $fillable = [
        'name', 'frequency', 'day', 'execution_time', 'condition',
        'sample_points', 'email_recipients',
    ];

    protected $casts = [
        'sample_points' => 'array',
    ];
}
