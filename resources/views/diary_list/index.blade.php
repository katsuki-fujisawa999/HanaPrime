@extends('layouts.layout')
@section('title','日記一覧')
@section('content')
<script>
</script>
<style>
    input[type="checkbox"] {
        width:20px;
        height:20px;
    }
</style>
<center>
    <h1>日記一覧</h1>
    <form id="新規投稿form" action="/regist_diary/index" name="新規投稿form">
        <button id="新規投稿">新規投稿</button>&nbsp;
    </form>
    <button id="削除">削除</button>
    <hr>
    <form id="削除form" action="/diary_list/削除" name="削除form">
    <p>
    <table id="日記一覧" cellpadding="5" width="800" border>
        <tr id="見出し">
            <th width="50"><input type="checkbox" id="全チェック"></th>
            <th width="150">日付</th>
            <th width="150">画像</th>
            <th>日記</th>
        </tr>
        @foreach ($diaries as $diary)
        <tr>
            <td align="center"><input type="checkbox" name="チェック" value="{{ $diary->id }}"></td>
            <td>{{ $diary->upload_date }}</td>
            <td></td>
            <td>{{ $diary->contents }}</td>
        </tr>
        @endforeach
    </table>
    </p>
    </form>
    {{ $diaries->links('pagination::semantic-ui') }}
    
</center>
<script src="/js/diary_list/index.js?{{date("YmdHis")}}"></script>
@endsection


