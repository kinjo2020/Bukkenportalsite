@extends('layouts.user.app')

@section('content')
<div>
    <h1 class="mb-3 text-center">閲覧済み一覧</h1>

    
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
                    {!! link_to_route('user.show', '詳細を見る', ['id' => $bukken->id], ['class' => 'text-right']) !!}
                    
                    <div class="d-flex justify-content-around mx-5 my-3 px-5">
                        {{-- 物件お問い合わせ --}}
                        <button class="btn btn-success">
                            {!! link_to_route('user.contact.input', 'この物件に問い合わせる', ['id' => $bukken->id], ['class' => 'text-white']) !!}
                        </button>
                        
                        {{-- お気に入り登録ボタン、削除ボタン --}}
                        @include('user.favorite_button.favorite_button')
                        
                        {{-- 閲覧済み削除ボタン --}}
                        {!! Form::open(['route' => ['user.bukken.unhistory', $bukken->id], 'method' => 'delete']) !!}
                            {!! Form::submit('閲覧済みから削除', ['class' => "btn btn-danger"]) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    
    <div class="text-center py-5 my-5">
        {!! link_to_route('user.index', 'ホームへ', [], ['class' => 'btn btn-primary']) !!}
    </div>
    
</div>
@endsection