@vite(['resources/css/app.css', 'resources/js/app.js'])
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
              <a href="/user/myticket" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">マイチケット</a>
              <a href="/user/tickets" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">みらいチケット掲示板</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- スマホ用メニュー -->
    <div class="sm:hidden" id="mobile-menu">
      <div class="px-2 pt-2 pb-3 space-y-1">
        <a href="/user/myticket" class="text-gray-300 hover:bg-gray-700 hover:text-white block px-3 py-2 rounded-md text-base font-medium">マイチケット</a>
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

<div class="bg-gray-200 py-8">
  <div class="text-center text-3xl font-bold mb-4">みらいチケット掲示板<br>皆さんから暖かい支援のチケットです</div>
        <form method="POST" action="{{ route('tickets.get') }}">
            @csrf
            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-full">取得する</button>
            <div class="container mx-auto px-4 py-8">
                <div class="flex flex-wrap -mx-2">
                    @foreach ($tickets as $ticket)
                        @if ($ticket->area_id == 1 || optional($ticket->prefecture)->pref_name === Auth::user()->pref)
                            @if ($ticket->use == 0)
                            <div class="w-full md:w-1/2 lg:w-1/3 p-2">
                                <div class="bg-white shadow-md rounded-md overflow-hidden relative">
                                    <img src="{{ $ticket->giftcard->image_url }}" alt="{{ $ticket->giftcard->card_name }}" class="h-64 w-full object-cover">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black opacity-75"></div>
                                    <div class="absolute bottom-0 left-0 p-4">
                                        <h2 class="font-bold text-xl text-white mb-2">{{ $ticket->product->product_name }}</h2>
                                        <p class="text-gray-300 text-base">{{ $ticket->gift_sender }}</p>
                                        <p class="text-gray-300 text-base">{{ $ticket->area->pref_name }}</p>
                                        <p class="text-white text-xl">{{ $ticket->product->price }}円</p>
                                    </div>
                                    <div class="p-4 absolute bottom-0 right-0">
                                        <label class="inline-flex items-center">
                                            <span class="ml-2">{{ $ticket->product->product_name }}</span>
                                            <input type="radio" name="ticket_id" value="{{ $ticket->id }}" class="form-radio">
                                        </label>
                                        <a href="#" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-full" data-modal-target="modal" data-ticket-id="{{ $ticket->id }}" data-gift-sender="{{ $ticket->gift_sender }}" data-gift-card-image="{{ $ticket->giftcard->image_url }}" data-message="{{ $ticket->message }}" data-product-name="{{ $ticket->product->product_name }}" data-price="{{ $ticket->product->price }}">詳細を見る</a>
                                    </div>
                                </div>
                            </div>
                            @endif
                        @endif
                     @endforeach
                </div>
             </div>
        </form>


<!-- モーダル用のHTML要素 -->
<div class="fixed top-0 left-0 w-full h-full bg-gray-900 bg-opacity-50 flex justify-center items-center hidden" id="modal">
    <div class="ticket-container max-w-md bg-white rounded-lg shadow-lg">
        <div class="ticket-info p-4">
            <p class="font-bold" id="gift-sender"></p>
            <img src="" alt="" class="h-64 w-full object-cover rounded-lg shadow-lg mt-4" id="gift-card-image">
            <p class="border-2 border-pink-500 p-4 my-4 break-all" id="message">応援メッセージ：<br>{{ $ticket->message }}</p>
            <p class="font-bold text-xl text-pink-500 mb-2" id="product-name"></p>
            <p class="text-pink-500 text-xl mb-2" id="price"></p>
            <p class="text-gray-500 limit-date">有効期限: 取得日から3カ月</p>
            <div class="flex justify-end mt-8">
                <button class="bg-pink-500 text-white font-bold py-2 px-4 rounded-full mr-4" id="close-modal-button">閉じる</button>
            </div>
        </div>
    </div>
</div>

<script>
    const openModalButtons = document.querySelectorAll('[data-modal-target]');
    const closeModalButton = document.getElementById('close-modal-button');
    const modal = document.getElementById('modal');
    const giftSender = document.getElementById('gift-sender');
    const giftCardImage = document.getElementById('gift-card-image');
    const message = document.getElementById('message');
    const productName = document.getElementById('product-name');
    const price = document.getElementById('price');

    openModalButtons.forEach(button => {
            button.addEventListener('click', () => {
            const modalTarget = button.dataset.modalTarget;
            const ticketId = button.dataset.ticketId;
            const giftSenderText = button.dataset.giftSender;
            const giftCardImageSrc = button.dataset.giftCardImage;
            const messageText = button.dataset.message;
            const productNameText = button.dataset.productName;
            const priceText = button.dataset.price;

            giftSender.textContent = giftSenderText;
            giftCardImage.src = giftCardImageSrc;
            message.textContent = `応援メッセージ：${messageText}`;
            productName.textContent = productNameText;
            price.textContent = `みらいチケット：${priceText}円`;

            document.getElementById(modalTarget).classList.remove('hidden');
        });
    });

    closeModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
    });
</script>


