<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserableTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use HasApiTokens, HasFactory, Notifiable;
    use InteractsWithMedia;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        
       'userable_type',
       'userable_id',
       'roles_name',
       'status'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'roles_name'=>'array'

    ];


    public function userable()
    {
        return $this->morphTo();
    }
    // public function admin()
    // {
    //     return $this->hasMany(Admin::class);
    // }
    // public function delegatesupervisors()
    // {
    //     return $this->hasMany(DelegateSupervisor::class);
    // }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
   public function replay()
   {
    return $this->belongsTo(TicketReply::class);
   }
}
