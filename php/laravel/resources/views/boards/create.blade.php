@extends('boards.layout')

@section('content')
글쓰기 진행

<form action="{{ route('boards.store') }}" method="post">
@csrf
<table border="1">
    <tr>
        <td>제목</td>
        <td><input type="text" name="subject" value=""/></td>
    </tr>
    <tr>
        <td>내용</td>
        <td><textarea name="contents" rows="5"></textarea></td>
    </tr>
    <tr>
        <td colspan="2">
            <button type="submit">저장</button>
        </td>
    </tr>
</table>
</form>

@endsection