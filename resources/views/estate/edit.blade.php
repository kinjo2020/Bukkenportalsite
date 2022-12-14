@extends('layouts.estate.app')

@section('content')

    <div class="container">
        
        {{-- エラーメッセージ --}}
        @if (count($errors) > 0)
            <ul class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                    <li class="ml-4">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    
        <h1 class="text-center">物件編集ページ</h1>
    
        <div>
            <div>
                {!! Form::model($bukken, ['route' => ['estate.update', $bukken->id], 'enctype' => 'multipart/form-data', 'method' => 'put' ]) !!}
    
                    <div class="form-group">
                        {!! Form::label('name', '物件名:') !!}
                        {!! Form::text('name', $bukken->name, ['class' => 'form-control']) !!}
                        
                        {!! Form::label('kinds', 'カテゴリー:') !!}
                        {!! Form::text('kinds', $bukken->kinds, ['class' => 'form-control']) !!}
                        
                        {!! Form::label('address', '住所:') !!}
                        {!! Form::text('address', $bukken->address, ['class' => 'form-control']) !!}
                        
                        {!! Form::label('rent', '賃料:') !!}
                        {!! Form::text('rent', $bukken->rent, ['class' => 'form-control']) !!}
                        
                        {!! Form::label('management_fee', '管理費:') !!}
                        {!! Form::text('management_fee', $bukken->management_fee, ['class' => 'form-control']) !!}
                        
                        {!! Form::label('floor', '所在階:') !!}
                        {!! Form::text('floor', $bukken->floor, ['class' => 'form-control']) !!}
                        
                        {!! Form::label('floor_plan', '間取り:') !!}
                        {!! Form::text('floor_plan', $bukken->floor_plan, ['class' => 'form-control']) !!}
                        
                        {!! Form::label('nearest_station', '最寄り駅:') !!}
                        {!! Form::text('nearest_station', $bukken->nearest_station, ['class' => 'form-control']) !!}
                        
                        {!! Form::label('age', '築年数:') !!}
                        {!! Form::text('age', $bukken->age, ['class' => 'form-control']) !!}
                        
                        {!! Form::label('picture', '物件画像:') !!}
                        {!! Form::file('picture', ['class' => 'd-block']) !!}
                    </div>
    
                    <div class="text-center py-5 my-5">
                        {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}
                        {!! link_to_route('estate.index', 'キャンセル', [], ['class' => 'btn btn-danger mx-5']) !!}
                    </div>
                    
    
                {!! Form::close() !!}
            </div>
        </div>
        
        <div class="row">
            @if (count($pictures) > 0)
                @foreach ($pictures as $picture)
                    <div class="m-3">
                        <img src="{{ asset($picture->image_path) }}" alt="物件画像">
                        
                        {{-- 物件画像削除フォーム --}}
                        {!! Form::model($picture, ['route' => ['estate.picture.destroy', $picture->id], 'method' => 'delete']) !!}
                            {!! Form::submit('画像削除', ['class' => 'my-1 btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </div>
                    
                @endforeach
            @endif
        </div>
        
    </div>
@endsection