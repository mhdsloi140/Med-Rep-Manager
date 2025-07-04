<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Admin extends Model
{
    use HasFactory;
    use  SoftDeletes;

  protected $fillable=['name','phone','image'];

  public function user()
  {
      return $this->morphOne(User::class, 'userable');
  }
// public function user()
// {
//     return $this->belongsTo(User::class);
// }
}
