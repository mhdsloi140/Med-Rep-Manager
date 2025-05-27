<?php

namespace App\Models;

use App\Enums\VisitsStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class  Visti extends Model
{
    use HasFactory;
    use SoftDeletes;

   protected $fillable = [
       'delegate_id',
       'doctor_id',
        'region_id'          ,
        'note',
        'visit_date',
        'visti_time',
        'status'
   ];

   protected $casts = [
    'status' => VisitsStatusEnum::class
   ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);    }

    public function delegate()
    {
        return $this->belongsTo(Delegate::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }
    public function vistiSamples()
    {
        return $this->hasMany(VistiSample::class);
    }
    public function samples()
    {
        return $this->belongsToMany(Sample::class,'visti_samples')->withPivot(['quantity','note']);
    }
}
