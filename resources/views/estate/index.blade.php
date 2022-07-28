@extends('layouts.estate.app')

@section('content')
<div>
    <div class="container">
        <h1 class="mb-3 text-center">物件管理</h1>
        
        <div class="mb-2 d-flex justify-content-end">
            {{-- 新規物件作成リンク --}}
            {!! link_to_route('estate.create', '新規物件作成', [], ['class' => 'btn btn-primary']) !!}
        </div>
        
        {{-- キーワード検索 --}}
        <form method="GET" action="{{ route('estate.index') }}">
            <div class="input-group my-3">
                <input type="search" class="form-control" placeholder="都道府県名・市区郡名で検索" name="search" value="@if (isset($search)) {{ $search }} @endif">
                <span class="input-group-btn">
                    <button class="btn btn-primary" type="submit">検索</button>
                    <button class="btn btn-secondary">
                        <a href="{{ route('estate.index') }}" class="text-white">
                            クリア
                        </a>
                    </button>
                </span>
            </div>
        </form>
    </div>
    
    @if (count($bukkens) > 0)
        @foreach ($bukkens as $bukken)
            <div class='container'>
                <div class="card-header d-flex align-items-center">
                    <strong>{{ $bukken->name }}</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-10">
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
                            {!! link_to_route('estate.show', '詳細を見る', ['id' => $bukken->id]) !!}
                        </div>
                    
                        <div class="col-md-2 d-flex justify-content-around align-items-center">
                            <div class="text-right">
                                {{-- 物件情報編集ページへのリンク --}}
                                {!! link_to_route('estate.edit', '編集', ['id' => $bukken->id], ['class' => 'btn btn-secondary m-2']) !!}
                                
                                {{-- 物件削除フォーム --}}
                                {!! Form::model($bukken, ['route' => ['estate.destroy', $bukken->id], 'method' => 'delete']) !!}
                                    {!! Form::submit('削除', ['class' => 'btn btn-danger m-2']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection