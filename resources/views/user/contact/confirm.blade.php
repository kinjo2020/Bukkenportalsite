@extends('layouts.user.app')

@section('content')
<h1 class="text-center">物件お問い合わせ（確認）</h1>

<form method="POST" action="{{ route('user.contact.send', $bukken->id) }}">
    @csrf

    <div class="form-group">
        <label>メールアドレス</label>
        <div class="form-control">
            {{ $inputs['email'] }}
            <input class="form-control" name="email" value="{{ $inputs['email'] }}" type="hidden">
        </div>
        
        <label>お問い合わせタイトル</label>
        <div class="form-control">
            {{ $inputs['title'] }}
            <input class="form-control" name="title" value="{{ $inputs['title'] }}" type="hidden">
        </div>
        
        <label>お問い合わせ内容</label>
        <div class="form-control">
            {!! nl2br(e($inputs['body'])) !!}
            <input class="form-control" name="body" value="{{ $inputs['body'] }}" type="hidden">
        </div>
        
        <div class="d-flex justify-content-around mx-5 my-3 px-5">
            <button class="btn btn-secondary" type="button" onClick="history.back()">
                入力内容修正
            </button>
            <button class="btn btn-primary" type="submit">
                送信する
            </button>
        </div>
    </div>
</form>
@endsection