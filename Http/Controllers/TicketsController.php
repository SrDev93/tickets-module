<?php

namespace Modules\Tickets\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Account\Entities\User;
use Modules\Tickets\Entities\Ticket;
use Modules\Tickets\Entities\TicketAttachment;
use Modules\Tickets\Entities\TicketMessage;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $items = Ticket::latest()->get();

        return view('tickets::index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        $users = User::all();

        return view('tickets::create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        try {
            $ticket = Ticket::create([
                'user_id' => $request->user_id,
                'subject' => $request->subject,
                'number' => $this->generateTicketNumber(),
                'status' => 0,
            ]);

            $message = TicketMessage::create([
                'ticket_id' => $ticket->id,
                'user_id' => Auth::id(),
                'message' => $request->message,
            ]);

            if (isset($request->attach)){
                foreach ($request->attach as $attach){
                    $ta = TicketAttachment::create([
                        'ticket_message_id' => $message->id,
                        'path' => file_org_store($attach, 'assets/uploads/tickets/attachments/', 'file_')
                    ]);
                }
            }

            return redirect()->route('tickets.index')->with('flash_message', 'با موفقیت ثبت شد');
        }catch (\Exception $e){
            return redirect()->back()->with('err_message', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show(Ticket $ticket)
    {
        return view('tickets::show', compact('ticket'));
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Ticket $ticket)
    {
        $users = User::all();

        return view('tickets::edit', compact('ticket', 'users'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Ticket $ticket)
    {
        try {
            $ticket->delete();

            return redirect()->route('tickets.index')->with('flash_message', 'با موفقیت حذف شد');
        }catch (\Exception $e){
            return redirect()->back()->with('err_message', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    public function reply(Request $request, Ticket $ticket)
    {
        try {
            $message = TicketMessage::create([
                'ticket_id' => $ticket->id,
                'user_id' => Auth::id(),
                'message' => $request->message,
            ]);

            if (isset($request->attach)){
                foreach ($request->attach as $attach){
                    $ta = TicketAttachment::create([
                        'ticket_message_id' => $message->id,
                        'path' => file_org_store($attach, 'assets/uploads/tickets/attachments/', 'file_')
                    ]);
                }
            }

            $ticket->status = 1;
            $ticket->save();

            return redirect()->back()->with('flash_message', 'با موفقیت ثبت شد');
        }catch (\Exception $e){
            return redirect()->back()->with('err_message', 'خطایی رخ داده است، لطفا مجددا تلاش نمایید');
        }
    }

    function generateTicketNumber() {
        $number = mt_rand(1000000000, 9999999999); // better than rand()

        // call the same function if the barcode exists already
        if ($this->TicketNumberExists($number)) {
            return $this->generateTicketNumber();
        }

        // otherwise, it's valid and can be used
        return $number;
    }

    function TicketNumberExists($number) {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Ticket::whereNumber($number)->exists();
    }
}
