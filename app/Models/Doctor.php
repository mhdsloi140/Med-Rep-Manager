<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Doctor extends Model  implements HasMedia
{
    use HasFactory;
    use SoftDeletes;
    use InteractsWithMedia;
    protected $guarded = [ 'id', 'created_at', 'updated_at' ];
    protected $fillable=['name','phone','specialty','image','longitude','latitude','region_id','delegate_id'];

    public function delegate()
    {
        return $this->belongsTo(Delegate::class);
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function vistis()
    {
        return $this->hasMany(Visti::class);
    }

    public function comments()
    {
        return $this->hasMany(DoctorComment::class);
    }
}
