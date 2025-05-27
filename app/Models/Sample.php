<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Sample extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;

    protected $translatedAttributes = ['name','description'];
    protected $guarded = ['id'];
    protected $fillable = ['company_id','quantity','image'];
    // protected $fallable = ['name','image','company_id'];
    public static function getTranslatedFields()
    {
        $self = new static;
        return $self->translatedAttributes;
    }
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function visits()
    {
        return $this->belongsToMany(Visti::class, 'visti_samples');
    }
}
