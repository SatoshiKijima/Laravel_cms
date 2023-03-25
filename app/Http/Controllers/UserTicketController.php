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
        return view('ticket', ['tickets' => $tickets]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserTicket  $userTicket
     * @return \Illuminate\Http\Response
     */
    public function show(UserTicket $userTicket)
    {
        return view('ticketdetail');
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
        //
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
}
