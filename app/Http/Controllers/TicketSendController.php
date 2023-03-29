<?php

namespace App\Http\Controllers;
use App\Mail\TicketSend;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Carbon\Carbon; // 追記
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\GiftCard;
use App\Models\UserTicket; // 追加

class TicketSendController extends Controller
{
    public function ticketsend(Request $request)
    {   
        
        $ticket = Ticket::findOrFail($request->ticket_id);
        $giftcard = DB::table('gift_cards')->select('id', 'image_url')->get();
        $product_name = $ticket->product->product_name;
        $price = $ticket->product->price;
        $expiry_date = date('Y年m月d日', strtotime($ticket->userTickets->first()->get_date . '+3 months'));
        $qrcode_url = 'https://example.com/qrcode/' . $ticket->id;
        $qrcode = \QrCode::size(200)->generate($ticket->id);
        
        $user_ticket = (object) [
        'gift_sender' => $request->gift_sender,
        'giftcard' => $request->giftcard,
        'product_name' => $product_name,
        'price' => $price,
        'message' => $request->message,
        'expiry_date' => $expiry_date,
        'qrcode_url' => $qrcode_url,
        'ticket_id' => $ticket->id,
        'recipient_email' => $request->recipient_email,
        'ticket' => $ticket, // $ticket 変数を追加
        'qrcode' => $qrcode, // QRコードを追加
    ];
    
        $user_ticket_id = $user_ticket->ticket_id; // 追加
        
        //  dd($user_ticket);
    
        return view('ticketsend', compact('user_ticket', 'user_ticket_id','ticket', 'qrcode'));
    }

    public function send_announce(Request $request)
    {
        // Mail::to($request->recipient_email)->send(new TicketSend($request->ticket_id));

         // Get ticket_id from the form
        $ticket_id = $request->input('ticket_id');
    
        // Find the ticket and user_ticket
        $ticket = Ticket::with('product')->findOrFail($ticket_id);
        $user_ticket = UserTicket::where('ticket_id', $ticket_id)
                                    ->where('user_id', auth()->id())
                                    ->firstOrFail();
                                    
        // Load the product
        $ticket->load('product');
    
        // Update ticket's use column
        $ticket->use = 2;
        $ticket->used_date = now();
        $ticket->save();
    
        // Get required data
        $product_name = $ticket->product->product_name;
        $price = $ticket->product->price;
        $expiry_date = date('Y年m月d日', strtotime($ticket->get_date . '+3 months'));
        $qrcode = \QrCode::size(200)->generate($ticket->id);
        
        // Prepare data for the view
        $data = [
            'gift_sender' => $ticket->gift_sender,
            'giftcard_id' => $ticket->giftcard_id,
            'message' => $ticket->message,
            'expiry_date' => $expiry_date,
            'ticket_id' => $ticket->id,
            'qrcode' => $qrcode,
            'ticket' => $ticket, // 追加
            'image_url' => $ticket->giftcard->image_url,
            'product_name' => $product_name, // 追加
            'price' => $price, // 追加
        ];
        
       
        // dd($data);
        
        return view('ticketsendcontents', $data);
        }
    
    public function send(Request $request)
    {
        $data = $request->validate([
            'ticket_id' => 'required|integer',
            'gift_sender' => 'required|string',
            'recipient_email' => 'required|email',
            'message' => 'nullable|string',
        ]);

        $ticket = Ticket::findOrFail($data['ticket_id']);

        Mail::to($data['recipient_email'])->send(new TicketSendMail($data, $ticket));

        $this->updateTicketStatus($ticket);

        return back()->with('status', 'チケットを送信しました');
    }
    
    private function updateTicketStatus(Ticket $ticket)
    {
        if ($ticket->use != 1) {
            return;
        }

        $ticket->use = 2;
        $ticket->used_date = now();
        $ticket->save();
    }
    
    public function generateQRCode($ticket_id) 
    {
        $qrcode = QrCode::size(300)->generate($ticket_id);
        return view('ticketcontent', compact('ticket_id', 'qrcode'));
    }
    
    public function ticketcontent($id)
    {
        $ticket_id = UserTicket::find($id)->ticket_id;
        $qrcode = QrCode::size(300)->generate($ticket_id);
        return view('ticketcontent', compact('ticket_id', 'qrcode'));
    }
}
