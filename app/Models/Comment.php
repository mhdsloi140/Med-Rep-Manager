<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
     protected $fillable = ['doctor_id', 'delegate_id', 'content'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }

    public function delegate()
    {
        return $this->belongsTo(Delegate::class);
    }

}
