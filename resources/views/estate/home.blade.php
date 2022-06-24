@extends('layouts.estate.app')

@section('content')
<div class="mb-3 mx-auto text-center" style="width:800px">
    <h1>物件管理</h1>
</div>

<div>
    @if (count($bukkens) > 0)
        @foreach ($bukkens as $bukken)
        <div class="card mx-auto" style="width:800px">
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
        @endforeach
    @endif
</div>
@endsection