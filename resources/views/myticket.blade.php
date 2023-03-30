@vite(['resources/css/app.css', 'resources/js/app.js'])


<!DOCTYPE html>
<html lang="ja">
  
<header>
@include('components.userheader')
<nav class="bg-gray-800">
      <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
          <!-- ロゴ -->
          <!-- ナビゲーションメニュー -->
          <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
            <div class="hidden sm:block sm:ml-6">
              <div class="flex space-x-4">
               <a href="/user/home" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">マイページホーム</a>
                <a href="/user/tickets" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">みらいチケット掲示板</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
</header>



@foreach ($tickets as $ticket)
  <div class="my-ticket">
    <div class="ticket-info">
      <div class="product-info">
        <p class="product-name">{{ $ticket->product->product_name }}</p>
        <p class="price">{{ $ticket->product->price }}円</p>
      </div>
      <div class="ticket-status">
        @if($ticket->use == 1)
          <p class="ticket-used">未利用</p>
        @elseif($ticket->use == 2)
          <p class="ticket-used">使用済</p>
        @else
          <p class="ticket-not-used">未使用</p>
        @endif
        @if($ticket->use == 1)
          <p class="get-date">取得日:{{ date('Y年m月d日', strtotime($ticket->userTickets->first()->get_date)) }}</p>
          <p class="limit-date">有効期限:{{ date('Y年m月d日', strtotime($ticket->userTickets->first()->get_date . '+3 months')) }}</p>
        @endif
      </div>
      <div class="ticket-img">
        <img src="{{ $ticket->giftcard->image_url }}" alt="{{ $ticket->giftcard->card_name }}" width="200" height="133">
      </div>
    </div>
    @if($ticket->use != 2)
        <form method="GET" action="{{ route('ticket_mailform') }}">
          @csrf
          <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
          <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full">チケットを利用（自分のメールに送信）</button>
        </form>
      @endif
    </div>
  </div>
@endforeach

{{ $tickets->links() }}