@extends('layouts.user.app')

@section('content')
<div>
    <h1 class="mb-3 text-center">物件一覧</h1>
    
    {{-- キーワード検索 --}}
    <form method="GET" action="{{ route('user.index') }}">
        <div class="input-group my-3">
            <input type="search" class="form-control" placeholder="都道府県名・市区郡名で検索" name="search" value="@if (isset($search)) {{ $search }} @endif">
            <span class="input-group-btn">
                <button class="btn btn-primary" type="submit">検索</button>
                <button class="btn btn-secondary">
                    <a href="{{ route('user.index') }}" class="text-white">
                        クリア
                    </a>
                </button>
            </span>
        </div>
    </form>
    
    @if (count($bukkens) > 0)
        @foreach ($bukkens as $bukken)
            <div class='border my-3'>
                <div class="card-header d-flex align-items-center">
                    <strong>{{ $bukken->name }}</strong>
                </div>
                <div class="card-body pb-0">
                    @if (count($pictures) > 0)
                        @foreach ($pictures as $picture)
                            @if ($picture->bukken_id === $bukken->id)
                                <img src="{{ asset($picture->image_path) }}" alt="物件画像">
                            @endif
                        @endforeach
                    @endif
                    <p>{{ $bukken->kinds }}</p>
                    <p>賃料：{{ $bukken->rent }} 円</p>
                    <p>管理費:{{ $bukken->management_fee }} 円</p>
                    <p>間取り:{{ $bukken->floor_plan }}</p>
                    <p>築年数:{{ $bukken->age }} 年</p>
                    <p>住所：{{ $bukken->address }}</p>
                    <p>最寄り駅：{{ $bukken->nearest_station }}</p>
                    
                    {{-- 物件詳細ページへのリンク --}}
                    {!! link_to_route('user.show', '詳細を見る', ['id' => $bukken->id]) !!}
                    
                    <div class="d-flex justify-content-around mx-5 my-3 px-5">
                        {{-- 物件お問い合わせ --}}
                        <button class="btn btn-success">
                            {!! link_to_route('user.contact.input', 'この物件に問い合わせる', ['id' => $bukken->id], ['class' => 'text-white']) !!}
                        </button>
                        
                        {{-- お気に入り登録ボタン、削除ボタン --}}
                        @include('user.favorite_button.favorite_button')
                        
                    </div>
                </div>
            </div>
        
        @endforeach
    @endif
</div>
@endsection