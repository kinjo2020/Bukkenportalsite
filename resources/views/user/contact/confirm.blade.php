@extends('layouts.user.app')

@section('content')
<h1>物件お問い合わせ（確認）</h1>

<form method="POST" action="{{ route('user.contact.send', $bukken->id) }}">
    @csrf

    <div class="form-group row">
        <label>メールアドレス</label>
        <div class="form-control">
            {{ $inputs['email'] }}
            <input class="form-control" name="email" value="{{ $inputs['email'] }}" type="hidden">
        </div>
        
        <label>タイトル</label>
        <div class="form-control">
            {{ $inputs['title'] }}
            <input class="form-control" name="title" value="{{ $inputs['title'] }}" type="hidden">
        </div>
        
        <label>お問い合わせ内容</label>
        <div class="form-control">
            {!! nl2br(e($inputs['body'])) !!}
            <input class="form-control" name="body" value="{{ $inputs['body'] }}" type="hidden">
        </div>
        
        <button type="button" onClick="history.back()">
            入力内容修正
        </button>
        <button type="submit">
            送信する
        </button>
    </div>
</form>
@endsection