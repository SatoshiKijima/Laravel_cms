<div class="container mx-auto px-4">
    <div class="flex flex-wrap -mx-2">
        @foreach ($tickets as $ticket)
             @if ($ticket->area_id == 1 || optional($ticket->prefecture)->pref_name === Auth::user()->pref)
                <div class="w-full md:w-1/2 lg:w-1/3 p-2">
                    <div class="bg-white shadow-md rounded-md overflow-hidden">
                        <img src="{{ $ticket->giftcard->image_url }}" alt="{{ $ticket->giftcard->card_name }}" class="h-32 w-auto mb-2">
                        <div class="p-4">
                            <h2 class="font-bold text-lg mb-2">{{ $ticket->product->product_name }}</h2>
                            <p class="text-gray-700 text-base">{{ $ticket->message }}</p>
                            <p class="text-gray-600 text-base">{{ $ticket->gift_sender }}</p>
                            <p class="text-gray-700 text-base">{{ $ticket->area->pref_name }}</p>
                            <p class="text-gray-900 text-xl">{{ $ticket->product->price }}円</p>
                            <div class="mt-4">
                                <a href="{{ route('ticket_show', $ticket) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-full">詳細を見る</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
