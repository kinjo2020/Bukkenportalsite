@extends('layouts.estate.app')

@section('content')
<div class="mx-auto" style="width:800px">
    <h1 class="mb-3 text-center">物件詳細</h1>
    
    <div>
        <div class="card-header d-flex align-items-center">
            <strong>{{ $bukken->name }}</strong>
        </div>
        <div class="card-body">
            <p>{{ $bukken->kinds }}</p>
            <p>賃料：{{ $bukken->rent }} 円</p>
            <p>管理費:{{ $bukken->management_fee }} 円</p>
            <p>間取り:{{ $bukken->floor_plan }}</p>
            <p>築年数:{{ $bukken->age }} 年</p>
            <p>住所：{{ $bukken->address }}</p>
            <p>最寄り駅：{{ $bukken->nearest_station }}</p>
        </div>
    </div>
</div>
@endsection