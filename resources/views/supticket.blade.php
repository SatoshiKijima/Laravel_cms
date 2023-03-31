@vite(['resources/css/app.css', 'resources/js/app.js'])



<!DOCTYPE html>
<html lang="ja">
 
<header>
@include('components.supheader')
<nav class="bg-gray-800">
      <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="relative flex items-center justify-between h-16">
          <!-- ロゴ -->
          <!-- ナビゲーションメニュー -->
          <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
            <div class="hidden sm:block sm:ml-6">
              <div class="flex space-x-4">
                <a href="/support/home" class="text-gray-300 hover:bg-gray-700 hover:text-white px-3 py-2 rounded-md text-sm font-medium">ホームに戻る</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
</header>

 <!--全エリア[START]-->
    <div class="flex bg-gray-100">

        <!--左エリア[START]--> 
        <div class="text-gray-700 text-left px-4 py-4 m-2">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-500 font-bold">
                    みらいチケット作成管理
                </div>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <!-- 本のタイトル -->
            <form action="{{ route('supticket_store') }}" method="POST" class="w-full max-w-lg">
                @csrf
                  <div class="flex flex-col px-2 py-2">
                   <!-- カラム１ -->
                    <div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                       ニックネーム
                      </label>
                      <input id="gift_sender" name="gift_sender" "appearance-none block w-full text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="">
                    </div>
                    <!-- カラム２ -->
                    <div class="w-full md:w-1/1 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            みらいチケット選択
                        </label>
                        <select for="product_id" name="product_id" class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" >
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->product_name }} - {{ $product->price }}円</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- カラム３ -->
                    <div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            発行枚数
                        </label>
                        <input for="numbers" name="numbers" class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" name="number" min="1" max="100" placeholder="">
                    </div>
                    <!-- カラム４ -->
                    <div class="w-full md:w-1/1 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        対象エリア
                      </label>
                     <select for="area_id" name="area_id" type="date" class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                         @foreach($prefectures as $prefecture)
                          <option value="{{ $prefecture->id }}">{{ $prefecture->pref_name }}</option>
                          @endforeach
                     </select>
                    </div>
                  </div>
                  <!-- カラム5 -->
                    <div class="w-full md:w-1/1 px-3 mb-6 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                        ギフトカード選択
                      </label>
                      <div class="flex flex-wrap">
                        @foreach($giftcards as $giftcard)
                          <div class="w-1/2 p-2">
                            <label>
                              <input type="radio" name="giftcard_id" value="{{ $giftcard->id }}" />
                              <img src="{{ $giftcard->image_url }}" alt="{{ $giftcard->card_name }}" width="150" height="100" />
                            </label>
                          </div>
                        @endforeach
                      </div>
                    </div>
                    <!-- カラム6 -->
                    <div class="w-full md:w-1/1 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                            メッセージ
                        </label>
                        <textarea id="message" name="message" rows="3" class="appearance-none block w-full text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"></textarea>
                    </div>
                  <!-- カラム7 -->
                  <div class="flex flex-col">
                      <div class="text-gray-700 text-center px-4 py-2 m-2">
                             <x-button class="bg-blue-500 rounded-lg">みらいチケット作成</x-button>
                      </div>
                   </div>
            </form>
        </div>
        <!--左エリア[END]--> 
    
    
    <!--右側エリア[START]-->
     <!--右側エリア[START]-->
    
    <!-- 現在のチケット -->
    <div class="flex flex-wrap">
    @if (isset($tickets) && count($tickets) > 0)
        @foreach ($tickets as $ticket)
            <div class="w-1/4 p-2">
                <h2 class="text-xl font-semibold mb-2">{{ $ticket->gift_sender }}</h2>
                <p class="text-lg font-medium mb-2">{{ $ticket->product->product_name }}-{{ $ticket->product->price }}円</p>
                <p class="text-lg font-medium mb-2">エリア:{{ $ticket->area->pref_name }}</p>
                 @if (is_object($ticket) && is_object($ticket->giftcard))
                    <div class="card">
                        <img src="{{ $ticket->giftcard->image_url }}" alt="{{ $ticket->giftcard->card_name }}" class="h-32 w-auto mb-2">
                    </div>
                @endif
                <div class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium @if ($ticket->use == 1) bg-green-500 text-white @elseif ($ticket->use == 2) bg-red-500 text-white @endif">
                    ステータス： 
                    @if ($ticket->use == 1)
                        取得済
                    @elseif ($ticket->use == 2)
                        利用済
                    @else
                        未使用
                    @endif
                </div>
                 <p class="text-lg font-medium mb-2">メッセージ: {{ mb_substr($ticket->message, 0, 20) }}</p>
                 @if ($ticket->use == 0)
                    <div class="flex">
                        <a href="{{ route('supticket_edit', $ticket->id)}}" class="mr-2 text-blue-500 hover:text-blue-700">編集</a>
                        <form id="delete-form" action="{{ route('supticket_delete', ['ticket' => $ticket->id]) }}" method="POST" onsubmit="return confirm('本当に削除してよろしいですか？');">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="id" value="{{ $ticket->id }}">
                            <button type="submit" class="text-red-500 hover:text-red-700">削除</button>
                        </form>
                    </div>
                @endif
                </div>
            @if ($loop->iteration % 8== 0)
                </div>
                <div class="flex flex-wrap">
            @endif
        @endforeach
    </div>

    @else
        <p>チケットはありません。</p>
    @endif
    
    <div>
    {{ $tickets->links()}}
    </div>
    <!--右側エリア[[END]-->    
    <!--右側エリア[[END]-->       

</div>
 <!--全エリア[END]-->
 
 
<script>
document.getElementById("delete-form").addEventListener("submit", function (event) {
  console.log("Form submitted.");
});
</script>