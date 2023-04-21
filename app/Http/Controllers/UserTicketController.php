<?php

namespace App\Http\Controllers;

use App\Models\UserTicket;
use Illuminate\Http\Request;
use App\Models\Ticket;  

class UserTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tickets = Ticket::with(['product', 'area', 'giftcard'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(12);
        $gift_sender = '例:太郎さん';
        return view('ticket', compact('tickets', 'gift_sender'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ticket_id' => 'required|integer',
        ]);
    
        $ticket = Ticket::findOrFail($validated['ticket_id']);
    
        if ($ticket->use == 1) {
            return back()->withErrors([
                'ticket_id' => 'すでに取得されたチケットです。',
            ]);
        }
    
        $ticket->use = 1;
        $ticket->obtained_at = Carbon::now();
        $ticket->user_id = Auth::id();
        $ticket->save();
    
        return redirect()->route('myticket');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserTicket  $userTicket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {   
        return view('showticket', [
            'image_url' => $ticket->giftcard->image_url,
            'gift_sender' => $ticket->gift_sender,
            'product_name' => $ticket->product->product_name,
            'price' => $ticket->product->price,
            'message' => $ticket->message,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserTicket  $userTicket
     * @return \Illuminate\Http\Response
     */
    public function edit(UserTicket $userTicket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserTicket  $userTicket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserTicket $userTicket)
    {
        $validated = $request->validate([
        'ticket_id' => 'required|integer',
        ]);
    
        $ticket = Ticket::findOrFail($validated['ticket_id']);
    
        if ($ticket->use != 1) {
            return back()->withErrors([
                'ticket_id' => 'このチケットはまだ取得されていません。',
            ]);
        }
    
        $ticket->use = 2;
        $ticket->save();
    
        return redirect()->route('ticket_index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserTicket  $userTicket
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserTicket $userTicket)
    {
        //
    }
    
    public function myticket(Request $request)
    {
        $user = auth()->user(); // ログインユーザーの取得
        $tickets = Ticket::with(['product', 'area', 'giftcard'])
                    ->whereIn('id', function($query) use ($user) {
                        $query->select('ticket_id')
                              ->from('user_tickets')
                              ->where('user_id', $user->id)
                              ->where('use', 1);
                    })
                    ->orderBy('created_at', 'asc')
                    ->paginate(16);
        return view('myticket', [
            'tickets' => $tickets,
        ]);
}

}
