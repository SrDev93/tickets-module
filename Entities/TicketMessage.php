<?php

namespace Modules\Tickets\Entities;

use App\Models\Seen;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected static function newFactory()
    {
        return \Modules\Tickets\Database\factories\TicketMessageFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function attachments() {
        return $this->hasMany(TicketAttachment::class, 'ticket_message_id', 'id');
    }

    public function seen()
    {
        return $this->morphMany(Seen::class, 'seenable');
    }
}
