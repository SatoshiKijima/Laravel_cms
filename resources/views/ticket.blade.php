@vite(['resources/css/app.css', 'resources/js/app.js'])
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
                <a href="/user/myticket" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">マイチケット</a>
                <a href="/user/tickets" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">みらいチケット掲示板</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
    </header>
    
  

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
                                        <a href="#" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-full" data-modal-target="modal">詳細を見る</a>
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
            <p class="font-bold">{{ $ticket->gift_sender }}さんからのみらいチケット(PokeGif)</p>
            <img src="{{ $ticket->giftcard->image_url }}" alt="{{ $ticket->product_name }}" class="h-64 w-full object-cover rounded-lg shadow-lg mt-4">
            <p class="border-2 border-pink-500 p-4 my-4 break-all">応援メッセージ：<br>{{ $ticket->message }}</p>
            <p class="font-bold text-xl text-pink-500 mb-2">{{ $ticket->product_name }}</p>
            <p class="text-pink-500 text-xl mb-2">みらいチケット：{{ $ticket->price }}円</p>
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

    openModalButtons.forEach(button => {
        button.addEventListener('click', () => {
            const modalTarget = button.dataset.modalTarget;
            document.getElementById(modalTarget).classList.remove('hidden');
        });
    });

    closeModalButton.addEventListener('click', () => {
        modal.classList.add('hidden');
    });
</script>

