<?php

namespace Modules\Tickets\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class TicketAttachment extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    protected static function newFactory()
    {
        return \Modules\Tickets\Database\factories\TicketAttachmentFactory::new();
    }
}
