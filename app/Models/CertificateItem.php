<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateItem extends Model
{
    use HasFactory;

     protected $guarded = [];

    public function certificate(){
        return $this->belongsTo(Certificate::class , 'certificate_id');
    }
}
