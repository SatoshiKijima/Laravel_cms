@vite(['resources/css/app.css', 'resources/js/app.js'])
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>

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
          <div class="sm:hidden">
            <button type="button" class="block text-gray-300 hover:text-white focus:text-white focus:outline-none" aria-expanded="false" aria-controls="mobile-menu" id="mobile-menu-button">
              <span class="sr-only">Toggle menu</span>
              <!-- このアイコンは好みに応じて変更してください -->
              <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
                <path class="hidden" fill-rule="evenodd" clip-rule="evenodd" d="M3 6h18v2H3V6zm0 5h18v2H3v-2zm0 5h18v2H3v-2z"/>
                <path class="block" fill-rule="evenodd" clip-rule="evenodd" d="M4 6h16v2H4V6zm0 5h16v2H4v-2zm0 5h16v2H4v-2z"/>
              </svg>
            </button>
          </div>
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
      <!-- スマホ用メニュー -->
    <div class="sm:hidden" id="mobile-menu">
      <div class="px-2 pt-2 pb-3 space-y-1">
        <a href="/user/home" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">マイページホーム</a>
        <a href="/user/tickets" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">みらいチケット掲示板</a>
      </div>
    </div>
  </nav>
</header>

<script>
  const mobileMenuButton = document.getElementById('mobile-menu-button');
  const mobileMenu = document.getElementById('mobile-menu');

  mobileMenuButton.addEventListener('click', () => {
    const expanded = mobileMenuButton.getAttribute('aria-expanded') === 'true' || false;
    mobileMenuButton.setAttribute('aria-expanded', !expanded);
    mobileMenu.classList.toggle('hidden');
  });
</script> 

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
          <p class="text-red-500 font-bold">利用済</p>
        @else
          <p class="text-blue-500 font-bold">未利用</p>
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
    @if($ticket->use == 2)
    <div class="ticket-info relative">
        @if (!isset($ticket->thanks) && empty($ticket->thanks))
         <button id="thanks-button" type="button" class="bg-green-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full mt-4 mx-auto block" onclick="showThanksForm(this)">支援者にメッセージを贈る</button>
        @else
          <button type="button" class="bg-gray-400 text-white font-bold py-2 px-4 rounded-full mt-4 mx-auto block" disabled>ありがとう送信済み</button> 
        @endif
      <div class="thanks-form bg-white border border-gray-200 shadow-md rounded-md p-4 mt-4" style="display: none;">
        <button type="button" class="absolute top-0 right-0 mt-2 mr-2 p-1 rounded-full text-gray-600 hover:text-gray-700" onclick="hideThanksForm(this)">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
        <form method="POST" action="{{ route('send_thanks') }}" onsubmit="handleSubmit(event)" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
          <div class="mt-4">
            <label for="message" class="block font-medium text-gray-700 mb-2">ありがとうのメッセージ:</label>
            <textarea name="message" id="message" rows="3" class="form-input rounded-md shadow-sm mt-1 block w-full" placeholder="感謝のメッセージを入力してください"></textarea>
          </div>
          <div class="mt-4">
            <label for="image" class="block font-medium text-gray-700 mb-2">画像:</label>
            <input type="file" name="image" id="image" class="form-input rounded-md shadow-sm mt-1 block w-full">
          </div>
          <div class="mt-4">
            <label for="video" class="block font-medium text-gray-700 mb-2">動画:</label>
            <input type="file" name="video" id="video" class="form-input rounded-md shadow-sm mt-1 block w-full">
          </div>
          <div class="mt-4 text-center">
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full inline-block" onclick="disableButton(this.querySelector('span'))">
              <span>送信する</span>
            </button>
          </div>
        </form>
        <div class="thanks-message mt-4 text-center" style="display: none;">
          <p class="text-gray-600 font-bold">感謝のメッセージを送信しました。</p>
        </div>
      </div>
    </div>
@endif
  </div>
@endforeach


<script>
function showThanksForm(button) {
  const ticketInfo = button.closest('.ticket-info');
  const thanksForm = ticketInfo.querySelector('.thanks-form');
  thanksForm.style.display = 'block';
}

function hideThanksForm(button) {
  const ticketInfo = button.closest('.ticket-info');
  const thanksForm = ticketInfo.querySelector('.thanks-form');
  thanksForm.style.display = 'none';
}

function disableButton(button) {
  button.disabled = true;
  button.textContent = 'ありがとう送信済み';
  button.classList.remove('bg-green-500');
  button.classList.add('bg-gray-400', 'cursor-not-allowed');
  const ticketInfo = button.closest('.ticket-info');
  const thanksForm = ticketInfo.querySelector('.thanks-form');
  thanksForm.style.display = 'none';
}
</script>


{{ $tickets->links() }}