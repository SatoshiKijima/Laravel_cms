<?php

namespace App\Http\Controllers;
use App\Models\GiftCard;
use Illuminate\Http\Request;

class GiftCardController extends Controller
{
    public function index()
    {
        $giftcards = GiftCard::all();
        return view('giftcard.index', compact('giftcards'));
    }

    public function show($id)
    {
        $giftcard = GiftCard::findOrFail($id);
        return view('giftcard.index', compact('giftcard'));
    }

    public function store(Request $request)
    {
        // 保存処理
    }
}