@extends('boards.layout')

@section('content')

<a href="{{ route('boards.index') }}">목록</a>
<h1>{{ $board->subject }}</h1>
<p>{{ $board->contents }}</p>
<p>{{ $board->created_at }}</p>
<p>{{ $board->updated_at }}</p>

@endsection