@vite(['resources/css/app.css', 'resources/js/app.js'])


<!DOCTYPE html>
<html lang="ja">
  
<header class="md:hidden">
  @include('components.userheader')
  <nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <!-- メニューボタン -->
        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
          <div class="flex items-center">
            <button type="button" class="bg-gray-800 inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white" aria-expanded="false">
              <span class="sr-only">Open main menu</span>
              <!-- ここにメニューバーアイコンを追加 -->
            </button>
            <!-- ナビゲーションメニュー -->
            <div class="hidden sm:block sm:ml-6">
              <div class="flex space-x-4">
                <a href="/user/home" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">マイページホーム</a>
                <a href="/user/tickets" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">みらいチケット掲示板</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- メニュー表示時に表示される部分 -->
    <div class="hidden" id="mobile-menu">
      <div class="px-2 pt-2 pb-3 space-y-1">
        <a href="/user/home" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">マイページホーム</a>
        <a href="/user/tickets" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">みらいチケット掲示板</a>
      </div>
    </div>
  </nav>
</header>



@foreach ($tickets as $ticket)
  <div class="my-ticket mx-auto py-4 px-6 sm:w-full md:w-1/2 lg:w-1/3">
    <div class="ticket-info border-2 border-gray-200 shadow-md rounded-md p-4">
      <div class="product-info text-center">
        <p class="text-lg font-medium">{{ $ticket->product->product_name }}</p>
        <p class="text-gray-600">{{ $ticket->product->price }}円</p>
      </div>
      <div class="ticket-status text-center mt-4">
        @if($ticket->use == 1)
          <p class="text-green-500 font-bold">未利用</p>
        @elseif($ticket->use == 2)
          <p class="text-red-500 font-bold">使用済</p>
        @else
          <p class="text-blue-500 font-bold">未使用</p>
        @endif
        @if($ticket->use == 1)
          <p class="text-gray-600 mt-2">取得日:{{ date('Y年m月d日', strtotime($ticket->userTickets->first()->get_date)) }}</p>
          <p class="text-gray-600 mt-2">有効期限:{{ date('Y年m月d日', strtotime($ticket->userTickets->first()->get_date . '+3 months')) }}</p>
        @endif
      </div>
      <div class="ticket-img mt-4">
        <img src="{{ $ticket->giftcard->image_url }}" alt="{{ $ticket->giftcard->card_name }}" class="w-full h-auto mx-auto rounded-md shadow-sm">
      </div>
    </div>
    @if($ticket->use != 2)
        <form method="GET" action="{{ route('ticket_mailform') }}">
          @csrf
          <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
          <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full mt-4 mx-auto block">チケットを利用（自分のメールに送信）</button>
        </form>
    @endif
  </div>
@endforeach

{{ $tickets->links() }}