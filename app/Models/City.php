<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class City extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    protected $guarded = ['id'];

    protected $translatedAttributes = ['name'];

    public static function getTranslatedFields()
    {
        $self = new static;
        return $self->translatedAttributes;
    }
    public function deleagates()
    {
        return $this->hasMany(City::class);
    }
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
    public function vistis()
    {
        return $this->hasMany(Visti::class);
    }
    public function Regions()
    {
        return $this->hasMany(Region::class);
    }
}
