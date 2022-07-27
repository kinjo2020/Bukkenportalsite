@extends('layouts.user.app')
 
@section('content')
<h1>物件お問い合わせ（入力）</h1>

<form method="POST" action="{{ route('user.contact.confirm', $bukken->id) }}">
    @csrf

    <div class="form-group">
        <label>メールアドレス</label>
        <input class="form-control" name="email" value="{{ old('email') }}" type="text">
        @if ($errors->has('email'))
            <p class="error-message">{{ $errors->first('email') }}</p>
        @endif
    
        <label>お問い合わせタイトル</label>
        <input class="form-control" name="title" value="{{ old('title') }}" type="text">
        @if ($errors->has('title'))
            <p class="error-message">{{ $errors->first('title') }}</p>
        @endif
    
    
        <label>お問い合わせ内容</label>
        <textarea class="form-control" name="body">{{ old('body') }}</textarea>
        @if ($errors->has('body'))
            <p class="error-message">{{ $errors->first('body') }}</p>
        @endif
    
        <button class="btn btn-primary" type="submit">
            入力内容確認
        </button>
    </div>
    
</form>
@endsection