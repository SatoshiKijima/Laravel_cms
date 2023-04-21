@vite(['resources/css/app.css', 'resources/js/app.js'])



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">


</head>

<header>
          @include('components.supheader')
          <nav class="bg-gray-800">
          <div class="hidden sm:block sm:ml-6">
          <div class="flex space-x-4">
            <a href="/support/home" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">ホームに戻る</a>
            <a href="/supuser/suptickets/arigato" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">利用されたみらいチケット一覧</a>
          </div>
        </div>
        <div class="sm:hidden" id="mobile-menu">
      <div class="px-2 pt-2 pb-3 space-y-1">
        <a href="/support/home" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">ホームに戻る</a>
        <a href="/supuser/suptickets/arigato" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">利用されたみらいチケット一覧</a>
      </div>
    </div>
        </nav>
    </header>

<body>
  <div>
  <h2 style="font-weight: bold;">みらいチケット支援実績</h2>
  <table style="width: 200px; border-collapse: collapse; border: 1px solid black;">
    <tr>
      <td style="border: 1px solid black; padding: 5px; font-weight: bold;">支援したチケットの数:</td>
      <td style="border: 1px solid black; padding: 5px; color: blue;">{{ $ticketCount }}枚発行済み</td>
    </tr>
    <tr>
      <td style="border: 1px solid black; padding: 5px; font-weight: bold;">支援したチケットの合計金額:</td>
      <td style="border: 1px solid black; padding: 5px; color: red;">{{ $totalPrice }}円</td>
    </tr>
    <tr>
      <td style="border: 1px solid black; padding: 5px; font-weight: bold;">使用済みチケットの数:</td>
      <td style="border: 1px solid black; padding: 5px; color: green;">{{ $usedCount }}人支援達成</td>
    </tr>
  </table>
</div>
  <div class="relative">
    <div style="text-align:center;">
      <h3 style="color: #FCA5A5; font-size: 36px;">ありがとうの木</h3>
      <p>花や果物をクリックすると支援した方からのメッセージが閲覧できます</p>
<div class="relative" style="width: 1800px; height: 1500px; margin: 80px auto 0; background-image: url('{{ asset('/storage/images/arigatotree.jpg') }}'); background-size: contain; background-position: center; background-repeat: no-repeat;">


    @php
$used_tickets = $tickets->where('use', 2)->shuffle();
$giftcard_count = $used_tickets->count();
@endphp
@foreach ($used_tickets as $ticket)
  @if ($ticket->giftcard)
    @php
      $image_url = $selected_images->random();
      $x_pos = rand(400, 1500);
      $y_pos = rand(150, 600);
    @endphp
    <div class="absolute" style="top: {{ $y_pos }}px; left: {{ $x_pos }}px;">
      <img src="{{ $image_url }}" alt="ギフトカード" class="block mx-auto w-12 rounded-full giftcard-image" data-ticket-id="{{ $ticket->id }}">
    </div>
  @endif
@endforeach

</div>
    </div>
  </div>
  <style>
    .giftcard-image {
      transform: scale(1.5);
    }
  </style>
</body>
</html>

<script>
 document.querySelectorAll('.giftcard-image').forEach(function(image) {
  image.addEventListener('click', function() {
    const ticketId = image.getAttribute('data-ticket-id');
    const messageOverlay = document.querySelector(`.message-overlay-${ticketId}`);
    messageOverlay.classList.remove('hidden');
    const closeMessageButton = messageOverlay.querySelector('.close-message-button');
      
    closeMessageButton.addEventListener('click', function() {
      messageOverlay.classList.add('hidden');
    });
  });
});

</script>



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
