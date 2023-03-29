  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
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
                <a href="/user/home" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">マイページホーム</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
    </header>
    
    
<div class="text-center">
  <div class="ticket-container max-w-md mx-auto">
    <div class="ticket-info">
      <p style="background-color: pink; color: Black; padding: 5px;"><strong>{{ $ticket->gift_sender }} さんからのみらいチケット(PokeGif)</strong></p><br>
      <img src="{{ $ticket->giftcard->image_url }}" alt="{{ $user_ticket->giftcard }}" class="h-64 w-full object-cover" width="280" height="210"><br>
      <p style="border: 2px double #FF1493; padding: 10px; max-width: 80%; word-wrap: break-word; text-align: center; margin: 0 auto;">{{ chunk_split($ticket->message, 15) }}</p>
      <h2 class="font-bold text-xl text-white mb-2">{{ $user_ticket->product_name }}</h2>
      <p class="text-white text-xl">みらいチケット：{{ $user_ticket->price }}円</p>
      <p class="limit-date">有効期限:{{ date('Y年m月d日', strtotime($ticket->userTickets->first()->get_date . '+3 months')) }}</p>
    </div>
      <div class="card-body" style="display:flex; justify-content:center;">
        {!! $qrcode !!}
      </div>
      <form action="{{ route('ticket_post_announce') }}" method="GET">
      @csrf
      <input type="hidden" name="ticket_id" value="{{ $user_ticket_id }}">
      <p class="sender" class="px-4 py-2 mt-4" >送信者名(ログイン名）: {{ Auth::user()->name }}</p>
      <p>チケット受取用メールアドレス:  <input type="email" class="px-4 py-2 mt-4" name="recipient_email" value="{{ Auth::user()->email }}" required><br>
      <button type="submit" class="px-4 py-2 mt-4 border border-gray-400 rounded-md bg-gray-400 hover:bg-navy hover:text-white hover:border-navy font-bold">メール送信</button>
    </form>
  </div>
</div>

<script>
    $(document).ready(function() {
        var qrcode = '{!! $qrcode !!}';
        $('#qrcode').html(qrcode);
    });
</script>

