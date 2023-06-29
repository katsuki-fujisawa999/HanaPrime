@extends('layouts.layout')
@section('title','日記一覧')
@section('content')
<script>
</script>
<style>
    input[type="checkbox"] {
        width:17px;
        height:17px;
    }
</style>
<center>
    <h1>日記一覧</h1>
    <form id="新規投稿form" action="/regist_diary/index" name="新規投稿form">
        <button id="新規投稿" onclick="return false;">新規投稿</button>&nbsp;
    </form>
    
    <form id="削除form" action="/diary_list/削除" name="削除form">
        <button id="削除" onclick="return false;">　削除　</button>
        <p>
            <table id="日記一覧" cellpadding="5" width="800" border>
                <tr id="見出し">
                    <th width="50"><input type="checkbox" id="全チェック"></th>
                    <th width="130">日付</th>
                    <th width="150">画像</th>
                    <th>日記</th>
                    <th width="70">編集</th>
                </tr>
                @foreach ($diaries as $diary)
                <tr>
                    <td align="center"><input type="checkbox" name="削除チェック[]" value="{{ $diary->id }}"></td>
                    <td>{{ substr($diary->upload_date, 0, 4) }}年{{ ltrim(substr($diary->upload_date, 4, 2), '0') }}月{{ ltrim(substr($diary->upload_date, 6, 2), '0') }}日</td>
                    <td><img src="/diary_list/getImage/{{ $diary->image_path }}" height="50"></td>
                    <td>{{ $diary->contents }}</td>
                    <td><button id="編集" value="{{ $diary->id }}" onclick="return false;">　編集　</button></td>
                </tr>
                @endforeach
            </table>
        </p>
    </form>
    
    <form id="編集form" action="/regist_diary/index/" name="編集form"></form>
    
    {{ $diaries->links('pagination::semantic-ui') }}
    
</center>
<script src="/js/diary_list/index.js?{{date("YmdHis")}}"></script>
@endsection


