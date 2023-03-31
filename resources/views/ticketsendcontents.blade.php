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
                <a href="/user/myticket/email/form" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">前のページに戻る</a>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
</header>
    
    <meta charset="UTF-8">
    <title>みらいチケットを送信しました</title>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <!-- Tailwind CSS を追加 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/3.0.6/tailwind.min.css" integrity="sha512-6MnvU6+j+SmTzTMTT30wncbQmlQIgYnB4btFJxWItZfxiaLMHQsftHjTgTISBw/qIev2yNPI7y9g4e8EbxW/fg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="bg-gray-100">
     <div class="max-w-md mx-auto mt-10">
        <h1 class="bg-pink-500 text-white font-bold text-2xl p-4 rounded-t-lg text-center">みらいチケットをメール送信しました</h1>
        <div class="ticket-container bg-white rounded-lg shadow-lg mt-4">
            <div class="ticket-info p-4">
                <p class="font-bold">{{ $ticket->gift_sender }} さんからのみらいチケット(PokeGif)</p>
                <img src="{{ $ticket->giftcard->image_url }}" alt="{{ $ticket->giftcard }}" class="h-64 w-full object-cover mt-4" width="280" height="210">
                <p class="border-2 border-pink-500 p-4 my-4" style="white-space: pre-line">応援メッセージ：<br>{{ $ticket->message }}</p>
                <p class="font-bold text-xl text-pink-500 mb-2">{{ $product_name }}</p>
                <p class="text-pink-500 text-xl mb-2">みらいチケット：{{ $price }}円</p>
                <p class="text-gray-500 limit-date">有効期限: {{ date('Y年m月d日', strtotime($ticket->get_date . '+3 months')) }}</p>
                <p class="text-gray-500 mt-4">送信者名(ログイン名）: {{ Auth::user()->name }}</p>
                <p class="text-gray-500 mt-4">チケット受取用メールアドレス:  <input type="email" class="px-4 py-2 mt-1 border border-gray-300 rounded-lg w-full" name="recipient_email" value="{{ Auth::user()->email }}" required></p>
            </div>
        </div>
    </div>
</body>

