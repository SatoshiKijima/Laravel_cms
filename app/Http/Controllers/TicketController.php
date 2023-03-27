<?php

namespace App\Http\Controllers;
use App\Models\Ticket;  
use App\Models\Prefecture;  
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\GiftCard;
use Auth;
use Validator;
use App\Models\UserTicket;


class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function index(Request $request)
        {   
            // dd(auth('supportusers')->user());//ユーザーメソッド
            $user = auth('supportusers')->user(); // ログインユーザーの取得
            $products = DB::table('products')->select('id', 'product_name','price')->get();
            $prefectures = DB::table('prefectures')->select('id', 'pref_name')->get();
            $giftcards = GiftCard::all();
            $tickets = Ticket::with(['product', 'area', 'giftcard'])
            ->where('support_user_id', $user->id) // ログインユーザーのチケットのみ取得
            ->orderBy('created_at', 'asc')
            ->paginate(16);
            return view('supticket', [
                
            'tickets' => $tickets,
            'products' => $products,
            'prefectures' => $prefectures,
            'giftcards' => $giftcards,
        ]);
        }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {   
        // dd(Auth::user());//ユーザーメソッド
        
        $products = DB::table('products')->select('id', 'product_name','price')->get();
        $prefectures = DB::table('prefectures')->select('id', 'pref_name')->get();
        $giftcards = GiftCard::all();

        return view('supticket', [
            'products' => $products,
            'prefectures' => $prefectures,
            'giftcards' => $giftcards,
            'ticket' => new Ticket(), // 空の Ticket モデルを渡す
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        $validator = Validator::make($request->all(), [
            'gift_sender' => 'required|min:1|max:255',
            'numbers' => 'required|min:1|max:10000',
            'area_id'   => 'required',
            'product_id'   => 'required',
            'giftcard_id'   => 'required',
        ]);

        if ($validator->fails()) {
            // バリデーションエラーの場合は、エラーメッセージと一緒に再度新規作成フォームを表示
            return redirect('/supuser/suptickets')
                ->withErrors($validator)
                ->withInput();
        }

        // データベースに保存
            for($i = 1; $i <= $request->numbers; $i++){
            $ticket = new Ticket();
            $ticket->support_user_id = Auth::guard('supportusers')->user()->id;
            $ticket->product_id = $request->product_id;
            $ticket->area_id = $request->area_id;
            $ticket->giftcard_id = $request->giftcard_id;
            $ticket->numbers = $i;
            $ticket->gift_sender = $request->gift_sender;
            $ticket->message = $request->message;
            $ticket->save();
        }

    // 保存したデータをビューに渡して、新規作成フォームを再度表示
        return redirect()->route('supticket_index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function edit(Ticket $ticket)
    {   
        
        $products = DB::table('products')->select('id', 'product_name','price')->get();
        $prefectures = DB::table('prefectures')->select('id', 'pref_name')->get();
        $giftcards = GiftCard::all();

        return view('supticketedit', [
            'products' => $products,
            'prefectures' => $prefectures,
            'giftcards' => $giftcards,
            'ticket' => $ticket, // 編集対象の Ticket モデルを渡す
        ]);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */

    // フォームから送信されたデータを更新するアクション
    public function update(Request $request, Ticket $ticket)
    {   
        
        $products = DB::table('products')->select('id', 'product_name','price')->get();
        $prefectures = DB::table('prefectures')->select('id', 'pref_name')->get();
        $giftcards = GiftCard::all();

        // データベースを更新
        $ticket = Ticket::where('id', $request->id)
                ->where('support_user_id', Auth::guard('supportusers')->user()->id)
                ->first();
                
        if ($ticket) {
        $ticket->product_id = $request->product_id;
        $ticket->area_id = $request->area_id;
        $ticket->giftcard_id = $request->giftcard_id;
        $ticket->gift_sender = $request->gift_sender;
        $ticket->message = $request->message;
        $ticket->save();

        
        // 更新したデータをビューに渡して、チケット一覧画面にリダイレクト
        return redirect()->route('supticket_index')->with('success', 'チケットを更新しました。');
        } else {
        return redirect()->back()->with('error', 'チケットが見つかりませんでした。');
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();       //追加
        return redirect()->route('supticket_index')->with('success', 'チケットを削除しました。');  //追加
    }
    
    public function get(Request $request)
    {
        $ticket = Ticket::find($request->ticket_id);

        if (!$ticket) {
            return redirect()->back()->with('error', 'チケットが見つかりませんでした。');
        }
        
        if ($ticket->use) {
            return redirect()->back()->with('error', 'チケットは既に取得されています。');
        }
        
        $ticket->use = 1;
        $ticket->get_date = now();
        $ticket->save();
        
        // チケットを取得したユーザーのIDを取得
        $user = Auth::user();
        $userId = $user->id;
        
        // userticketsテーブルにデータを保存
        $userTicket = new UserTicket;
        $userTicket->ticket_id = $request->ticket_id;
        $userTicket->use = 1;
        $userTicket->user_id = $userId;
        $userTicket->get_date = now();
        $userTicket->save();
        
        $expirationDate = now()->addMonths(3);
        
        return redirect()->route('myticket_index');
    }
    
    public function myticket(Request $request)
    {
        $user = auth()->user(); // ログインユーザーの取得

        $tickets = Ticket::with(['product', 'area', 'giftcard', 'userTickets'])
            ->whereHas('userTickets', function ($query) use ($user) {
                $query->where('user_id', $user->id)
                      ->whereIn('use', [1, 2]);
            })
            ->orderBy('created_at', 'asc')
            ->paginate(16);
    
        return view('myticket', [
            'tickets' => $tickets,
        ]);

    } 
    
    public function updateUsed(Request $request)
    {
        $userTicket = UserTicket::where('id', $request->id)->first();
    
        if ($userTicket) {
            $userTicket->use = 2;
            $userTicket->used_date = now();
            $userTicket->save();
    
            $ticket = Ticket::where('id', $userTicket->ticket_id)->first();
            if ($ticket) {
                $ticket->use = 2;
                $ticket->save();
            }
            return redirect()->back()->with('success', 'チケットを使用済みに更新しました。');
        } else {
            return redirect()->back()->with('error', 'チケットが見つかりませんでした。');
        }
    }
}
