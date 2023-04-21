<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Thanks;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\GiftCard;
use Validator;


class ThanksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function sendThanks(Request $request)
    {
        // dd($request->all());
        // imageとvideoの中身を確認する
    // dd($request->file('image'));
    // dd($request->file('video'));
        $request->validate([
            'message' => 'required|string|max:500',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5000000',
            'video' => 'nullable|mimes:mp4,avi,mov|max:200000000',
        ]);

        $ticket_id = $request->input('ticket_id');
        $ticket = Ticket::find($ticket_id);

        // チケットが利用済みであることを確認する
        if ($ticket->use != 2) {
            return redirect()->back()->withErrors(['message' => 'このチケットは利用済みではありません。']);
        }

        // 画像の保存
        $image_path = null;
        if ($request->hasFile('image')) {
        $image = $request->file('image');
        $image_name = $image->getClientOriginalName();
        $image_path = $image->storeAs('public/storage/thanks', $image_name);
        }

         // 動画の保存
        $video_path = null;
        if ($request->hasFile('video')) {
            $video = $request->file('video');
            $video_name = $video->getClientOriginalName();
            $video_path = $video->storeAs('public/storage/thanks', $video_name);
        }


        $thanks = new Thanks();
        $thanks->ticket_id = $ticket_id;
        $thanks->user_id = Auth::id();
        $thanks->support_user_id = $ticket->support_user_id;
        $thanks->message = $request->input('message');
        $thanks->image_path = $image_path;
        $thanks->video_path = $video_path;
        $thanks->save();

        return redirect()->route('myticket_index')->with('success', '感謝のメッセージを送信しました。');
    }
    
    public function index()
    {
        //
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
     * @param  \App\Models\Thanks  $thanks
     * @return \Illuminate\Http\Response
     */
    public function show(Thanks $thanks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Thanks  $thanks
     * @return \Illuminate\Http\Response
     */
    public function edit(Thanks $thanks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Thanks  $thanks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Thanks $thanks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Thanks  $thanks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Thanks $thanks)
    {
        //
    }
}
