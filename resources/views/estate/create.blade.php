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
    
        <h1 class="text-center">新規物件作成ページ</h1>
    
        <div>
            <div>
                {!! Form::model($bukken, ['route' => 'estate.store', 'enctype' => 'multipart/form-data']) !!}
    
                    <div class="form-group">
                        {!! Form::label('name', '物件名:') !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}
                        
                        {!! Form::label('kinds', 'カテゴリー:') !!}
                        {!! Form::text('kinds', null, ['class' => 'form-control']) !!}
                        
                        {!! Form::label('address', '住所:') !!}
                        {!! Form::text('address', null, ['class' => 'form-control']) !!}
                        
                        {!! Form::label('rent', '賃料:') !!}
                        {!! Form::text('rent', null, ['class' => 'form-control']) !!}
                        
                        {!! Form::label('management_fee', '管理費:') !!}
                        {!! Form::text('management_fee', null, ['class' => 'form-control']) !!}
                        
                        {!! Form::label('floor', '所在階:') !!}
                        {!! Form::text('floor', null, ['class' => 'form-control']) !!}
                        
                        {!! Form::label('floor_plan', '間取り:') !!}
                        {!! Form::text('floor_plan', null, ['class' => 'form-control']) !!}
                        
                        {!! Form::label('nearest_station', '最寄り駅:') !!}
                        {!! Form::text('nearest_station', null, ['class' => 'form-control']) !!}
                        
                        {!! Form::label('age', '築年数:') !!}
                        {!! Form::text('age', null, ['class' => 'form-control']) !!}
                        
                        {!! Form::label('picture', '物件画像:') !!}
                        {!! Form::file('picture') !!}
                    </div>
    
                    <div class="text-center py-5 my-5">
                        {!! Form::submit('作成', ['class' => 'btn btn-primary mx-5']) !!}
                        {!! link_to_route('estate.index', 'キャンセル', [], ['class' => 'btn btn-danger mx-5']) !!}
                    </div>
                    
    
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection