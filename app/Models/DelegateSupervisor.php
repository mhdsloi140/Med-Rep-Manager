<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
// use Spatie\MediaLibrary\InteractsWithMedia;

class DelegateSupervisor extends Model implements HasMedia
{
    use HasFactory;
    use  SoftDeletes;
    use InteractsWithMedia;

    protected $fillable=['name','phone'];


    public function user()
    {
        return $this->morphOne(User::class, 'userable');
    }
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }
}
