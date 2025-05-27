<?php

namespace App\Models;

use App\Enums\TicketStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ticket extends Model
{
    use HasFactory;
   protected $guarded=["id","created_at","updated_at"];
//    protected $fillable=["title","discraption","status","ticketable_id","ticketable_type","delegate_id"];
     protected $fillable=['title','description','ticketable_type','ticketable_id','delegate_id'];
   protected $casts = [
    'status' => TicketStatusEnum::class
   ];
//   public function ticketReplies()
//     {
//         return $this->hasMany(TicketReply::class);
//     }

    public function ticketable()
    {
        return $this->morphTo('ticketable');
    }

    public function delegate()
    {
        return $this->belongsTo(Delegate::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function ticketReplies()
    {
        return $this->hasMany(TicketReply::class);
    }


}
