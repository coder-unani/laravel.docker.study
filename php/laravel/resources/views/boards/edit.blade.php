@extends('boards.layout')

@section('content')
글쓰기 진행

<form action="{{ route('boards.update', $board->id) }}" method="post">
@csrf
@method('PUT')
<table border="1">
    <tr>
        <td>제목</td>
        <td><input type="text" name="subject" value="{{ $board->subject }}"/></td>
    </tr>
    <tr>
        <td>내용</td>
        <td><textarea name="contents" rows="5">{{ $board->contents }}</textarea></td>
    </tr>
    <tr>
        <td colspan="2">
            <button type="submit">수정</button>
        </td>
    </tr>
</table>
</form>

@endsection