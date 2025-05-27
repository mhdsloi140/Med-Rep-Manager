<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Region extends Model implements TranslatableContract
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;

    protected $guarded = ['id'];
    protected $translatedAttributes = ['name'];

    public static function getTranslatedFields()
    {
        $self = new static;
        return $self->translatedAttributes;
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
