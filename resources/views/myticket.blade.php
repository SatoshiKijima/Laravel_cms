@vite(['resources/css/app.css', 'resources/js/app.js'])


<!DOCTYPE html>
<html lang="ja">
  
<header>
@include('components.userheader')
</header>



@foreach ($tickets as $ticket)
  <div class="my-ticket">
    <div class="ticket-info">
      <div class="product-info">
        <p class="product-name">{{ $ticket->product->product_name }}</p>
        <p class="price">{{ $ticket->product->price }}円</p>
      </div>
      <div class="ticket-status">
        @if($ticket->use == 1)
          <p class="ticket-used">取得済</p>
        @elseif($ticket->use == 2)
          <p class="ticket-used">使用済</p>
        @else
          <p class="ticket-not-used">未使用</p>
        @endif
        @if($ticket->use == 1)
          <p class="get-date">取得日:{{ date('Y年m月d日', strtotime($ticket->userTickets->first()->get_date)) }}</p>
          <p class="limit-date">有効期限:{{ date('Y年m月d日', strtotime($ticket->userTickets->first()->get_date . '+3 months')) }}</p>
        @endif
      </div>
      <div class="ticket-img">
        <img src="{{ $ticket->giftcard->image_url }}" alt="{{ $ticket->giftcard->card_name }}" width="200" height="133">
      </div>
    </div>
    <form method="POST" action="{{ route('ticket_update') }}">
      @csrf
      @method('PUT')
      <input type="hidden" name="id" value="{{ $ticket->id }}">
      <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-full">使用する</button>
    </form>
  </div>
@endforeach

{{ $tickets->links() }}