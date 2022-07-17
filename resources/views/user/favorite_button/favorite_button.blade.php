@if (Auth::guard('user')->user()->is_favorite($bukken->id))
    {{-- お気に入り削除ボタン --}}
    {!! Form::open(['route' => ['user.bukken.unfavorite', $bukken->id], 'method' => 'delete']) !!}
        {!! Form::submit('お気に入り削除', ['class' => 'btn btn-secondary']) !!}
    {!! Form::close() !!}
@else
    {{-- お気に入り登録ボタン --}}
    {!! Form::open(['route' => ['user.bukken.favorite', $bukken->id]]) !!}
        {!! Form::submit('お気に入り登録', ['class' => 'btn btn-primary']) !!}
    {!! Form::close() !!}
@endif