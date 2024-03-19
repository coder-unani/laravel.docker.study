@extends('boards.layout')

@section('content')
여기에 게시판을 만들겁니다. 

<a href="{{ route('boards.create') }}">글쓰기</a>

<table border="1">
    <tr>
        <th>No</th>
        <th>제목</th>
        <th>작성일</th>
        <th>관리</th>
    </tr>
    @foreach ($lists as $list)
    <tr>
        <td>{{ $list->id }}</td>
        <td>{{ $list->subject }}</td>
        <td>{{ $list->created_at }}</td>
        <td>
        <a href="{{ route('boards.show', $list->id) }}">보기</a>
            <a href="{{ route('boards.edit', $list->id) }}">수정</a>
            <form action="{{ route('boards.destroy', $list->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit">삭제</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection