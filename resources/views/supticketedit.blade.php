@vite(['resources/css/app.css', 'resources/js/app.js'])



<!DOCTYPE html>
<html lang="ja">
  
<header>
@include('components.supheader')
</header>
 <!--全エリア[START]-->
    <div class="flex bg-gray-100">

        <!--左エリア[START]--> 
        <div class="text-gray-700 text-left px-4 py-4 m-2">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-500 font-bold">
                    みらいチケット更新管理
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
    
        <form action="{{ route('supticket_update') }}" method="POST" class="w-full max-w-lg">
                @csrf
                <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
                  <div class="flex flex-col px-2 py-2">
                   <!-- カラム１ -->
                    <div class="w-full md:w-1/1 px-3 mb-2 md:mb-0">
                      <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">
                       ニックネーム
                      </label>
                      <input id="gift_sender" value="{{ $ticket->gift_sender }}"   name="gift_sender" "appearance-none block w-full text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" type="text" placeholder="">
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
                        <input for="numbers" value="{{ $ticket->numbers }}" name="numbers" class="appearance-none block w-full text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" type="number" name="number" min="1" max="100" placeholder="">
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
                        <textarea id="message" value="{{ $ticket->message }}" name="message" rows="3" class="appearance-none block w-full text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"></textarea>
                    </div>
                  <!-- カラム7 -->
                  <div class="flex flex-col">
                      <div class="text-gray-700 text-center px-4 py-2 m-2">
                             <x-button class="bg-blue-500 rounded-lg">みらいチケット更新</x-button>
                             <!-- id値を送信 -->
                            <input type="hidden" name="id" value="{{$ticket->id}}">
                            <!--/ id値を送信 -->
                      </div>
                   </div>
        </form>
    </div>
        <!--左エリア[END]--> 
        
         <!--右側エリア[START]--><div class="flex-1 text-gray-700 text-left bg-blue-100 px-4 py-2 m-2">
      
                                </div>
    
    <!-- 現在のチケット -->
   


    <!--右側エリア[[END]-->    