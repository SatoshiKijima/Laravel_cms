<form action="{{ route('thanks.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="message">メッセージ</label>
        <textarea name="message" id="message" class="form-control" rows="5"></textarea>
    </div>
    <div class="form-group">
        <label for="image">画像</label>
        <input type="file" name="image" id="image" class="form-control-file">
    </div>
    <div class="form-group">
        <label for="video">動画</label>
        <input type="file" name="video" id="video" class="form-control-file">
    </div>
    <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
    <button type="submit" class="btn btn-primary">送信する</button>
</form>