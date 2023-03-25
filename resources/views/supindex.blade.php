 <!--右側エリア[START]-->
    
    <!-- 現在のチケット -->
    @if (count($tickets) > 0)
        @foreach ($tickets as $ticket)
            <div class="mb-4">
                <h2 class="text-xl font-semibold mb-2">{{ $ticket->gift_sender }}</h2>
                <p class="text-lg font-medium mb-2">{{ $ticket->product->product_name }}</p>
                <p class="text-lg font-medium mb-2">{{ $ticket->area->pref_name }}</p>
                <img src="{{ $ticket->giftcard->image_url }}" alt="{{ $ticket->giftcard->card_name }}" class="h-32 w-auto mb-2">
                <p class="text-lg font-medium mb-2">{{ $ticket->message }}</p>
                <div class="flex">
                    <a href="{{ route('supticket.edit', $ticket->id) }}" class="mr-2 text-blue-500 hover:text-blue-700">編集</a>
                    <form action="{{ route('supticket.destroy', $ticket->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">削除</button>
                    </form>
                </div>
            </div>
        @endforeach
    @else
        <p>チケットはありません。</p>
    @endif

    <!--右側エリア[[END]-->    