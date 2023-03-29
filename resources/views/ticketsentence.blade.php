@component('mail::message')
# チケットを受け取りました

以下は、あなたが受け取ったチケットの詳細です。

商品名: {{ $ticket->product->product_name }}
価格: {{ $ticket->product->price }}円
メッセージ: {{ $ticket->message }}
有効期限: {{ $ticket->userTickets->first()->get_date->addMonths(3)->format('Y年m月d日') }}

@component('mail::button', ['url' => 'https://example.com/myticket'])
マイチケット画面へ
@endcomponent

ありがとうございました。<br>
{{ config('app.name') }}
@endcomponent
