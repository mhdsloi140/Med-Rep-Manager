<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DoctorComment extends Model
{
    use HasFactory;
       protected $fillable = ['delegate_id', 'doctor_id', 'comment'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function delegate()
    {
        return $this->belongsTo(Delegate::class);
    }
}
