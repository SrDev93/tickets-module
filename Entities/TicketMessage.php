<?php

namespace Modules\Tickets\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Modules\Account\Entities\User;

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
}
