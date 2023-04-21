 <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
@vite(['resources/css/app.css', 'resources/js/app.js'])



<!DOCTYPE html>
<html lang="ja">
 
<header>
  @include('components.supheader')
  <nav class="bg-gray-800">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
      <div class="relative flex items-center justify-between h-16">
        <!-- ロゴ -->
        <!-- ハンバーガーメニュー -->
        <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
          <div class="sm:hidden">
            <button type="button" class="block text-gray-300 hover:text-white focus:text-white focus:outline-none" aria-expanded="false" aria-controls="mobile-menu" id="mobile-menu-button">
              <span class="sr-only">Toggle menu</span>
            <!-- ハンバーガーアイコン -->
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
        </div>
        <!-- ナビゲーションメニュー -->
        <div class="hidden sm:block sm:ml-6">
          <div class="flex space-x-4">
            <a href="/support/home" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">ホームに戻る</a>
            <a href="/supuser/suptickets" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">みらいチケットを発行する</a>
            <a href="/supuser/suptickets/summary" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">みらいチケット履歴</a>
          </div>
        </div>
      </div>
      </div>
    </div>

    <!-- モバイル用のナビゲーションメニュー -->
    <div class="sm:hidden" id="mobile-menu">
      <div class="px-2 pt-2 pb-3 space-y-1">
        <a href="/support/home" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">ホームに戻る</a>
        <a href="/supuser/suptickets" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">みらいチケットを発行する</a>
        <a href="/supuser/suptickets/summary" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">みらいチケット履歴</a>
      </div>
    </div>
  </nav>
</header>
<script>
  const mobileMenuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');

  mobileMenuButton.addEventListener('click', function() {
    const expanded = mobileMenuButton.getAttribute('aria-expanded') === 'true' || false;
    mobileMenuButton.setAttribute('aria-expanded', !expanded);
    mobileMenu.classList.toggle('hidden');
  });
</script>

<div class="flex flex-wrap">
    @if (isset($tickets) && count($tickets) > 0)
        @foreach ($tickets as $ticket)
           <div class="w-full sm:w-1/2 md:w-3/8 lg:w-1/5 p-2">
            <h2 class="text-xl font-semibold mb-2">{{ $ticket->gift_sender }}</h2>
            <p class="text-lg font-medium mb-2">{{ $ticket->product->product_name }}-{{ $ticket->product->price }}円</p>
            <p class="text-lg font-medium mb-2">エリア:{{ $ticket->area->pref_name }}</p>
            @if (is_object($ticket) && is_object($ticket->giftcard))
                <div class="card">
                    <img src="{{ $ticket->giftcard->image_url }}" alt="{{ $ticket->giftcard->card_name }}" class="h-32 w-32 object-cover mb-2">
                </div>
            @endif
            <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium @if ($ticket->use == 1) bg-green-500 text-white @elseif ($ticket->use == 2) bg-red-500 text-white @endif">
                ステータス：利用済
            </div>
            @if (isset($thanks[$ticket->id]))
               <button class="bg-green-500 text-white rounded-md px-2 py-1 mb-2 message-button" data-ticket-id="{{ $ticket->id }}" data-thanks-id="{{ $thanks[$ticket->id]->id }}">お礼メッセージ返信があります</button>
            @endif
         </div>
        @endforeach
    @else
        <p>チケットはありません。</p>
    @endif
    <div>
        {{ $tickets->links() }}
    </div>
</div>

@foreach ($tickets as $ticket)
<div class="fixed inset-0 z-50 hidden message-overlay-{{ $ticket->id }} overflow-y-hidden">
  <div class="flex items-center justify-center h-screen max-h-screen">
    <div class="bg-white rounded-lg shadow-lg p-4 w-1/2 sm:w-1/3 md:w-1/4 lg:w-1/5 max-h-screen border-l-4 border-pink-500 border-opacity-50">
      <div class="flex justify-between mb-2">
        <h2 class="text-xl font-semibold text-pink-500">ありがとうメッセージ</h2>
        <button class="text-gray-600 hover:text-gray-800 focus:outline-none focus:text-gray-800 close-message-button" data-ticket-id="{{ $ticket->id }}">&times;</button>
      </div>
      <div class="overflow-y-auto max-h-full">
        @if (!is_null($ticket->thanks))
          <div class="bg-gray-100 px-4 py-2 mb-4 rounded-md">
            <p class="text-lg font-semibold text-gray-800 mb-1">{{ $ticket->gift_sender }} 様</p>
            <p class="text-sm text-gray-700">{{ $ticket->thanks->message }}</p>
          </div>
          @if (!empty($ticket->thanks->image_path))
            <div class="mb-4">
              <p class="card-text font-weight-bold">画像</p>
              <img src="{{ asset($ticket->thanks->image_path) }}" alt="message image" class="img-thumbnail">
            </div>
          @endif
          @if (!empty($ticket->thanks->video_path))
            <div>
              <p class="card-text font-weight-bold">動画</p>
              <video controls class="w-100">
                <source src="{{ asset($ticket->thanks->video_path) }}" type="video/mp4">
              </video>
            </div>
          @endif
          <div class="border-t-2 border-gray-600 mt-4 pt-2 text-right">
            <p class="text-xs text-gray-700">送信日: {{ $ticket->thanks->created_at }}</p>
          </div>
        @else
          <p>お礼メッセージはありません。</p>
        @endif
      </div>
    </div>
  </div>
</div>
@endforeach



<script>
  document.querySelectorAll('.message-button').forEach(function(button) {
    button.addEventListener('click', function() {
      const ticketId = button.getAttribute('data-ticket-id');
      const messageOverlay = document.querySelector(`.message-overlay-${ticketId}`);
      messageOverlay.classList.remove('hidden');
      const closeMessageButton = messageOverlay.querySelector('.close-message-button');
      
      closeMessageButton.addEventListener('click', function() {
        messageOverlay.classList.add('hidden');
      });
    });
  });
</script>
