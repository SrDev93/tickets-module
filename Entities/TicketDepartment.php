<?php

namespace Modules\Tickets\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Tickets\Database\Factories\TicketDepartmentFactory;

class TicketDepartment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $guarded = ['id', 'created_at', 'updated_at'];

    // protected static function newFactory(): TicketDepartmentFactory
    // {
    //     // return TicketDepartmentFactory::new();
    // }
}
