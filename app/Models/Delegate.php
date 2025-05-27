<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Delegate extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [ 'id', 'created_at', 'updated_at' ];
    protected $fillable =[
        'name',
        'email',
        'phone',
        'password',
        'image',
        'delegate_id'
    ];

    public function vistis()
    {
        return $this->hasMany(Visti::class);
    }

    public function userable()
    {
        return $this->morphTo();
    }
    public function tickets()
    {
         $this->hasMany(Ticket::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }

    public function comments()
    {
        return $this->hasMany(DoctorComment::class);
    }

public function notifications()
{
    return $this->morphMany(Notification::class, 'model');
}

}

