<form action="{{ route('supticket_create') }}" method="POST">
  @csrf
  @foreach($giftcards as $giftcard)
    <div>
      <label>
        <input type="radio" name="giftcard_id" value="{{ $giftcard->id }}" />
        <img src="{{ $giftcard->image_url }}" alt="{{ $giftcard->card_name }}" />
      </label>
    </div>
  @endforeach
  <button type="submit">登録する</button>
</form>