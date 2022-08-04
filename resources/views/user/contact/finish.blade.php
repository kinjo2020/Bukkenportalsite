@extends('layouts.user.app')
 
@section('content')
<h1 class="text-center">物件お問い合わせ（完了）</h1>

<div class="container mt-5 p-lg-5 bg-light">
    メール送信しました！
</div>

<div class="text-center py-5 my-5">
    {!! link_to_route('user.index', 'ホームへ', [], ['class' => 'btn btn-primary']) !!}
</div>
@endsection