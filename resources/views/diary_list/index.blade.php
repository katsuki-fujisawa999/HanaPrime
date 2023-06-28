@extends('layouts.layout')
@section('title','日記一覧')
@section('content')
<script>
</script>
<center>
    <h2>日記一覧</h2>
    <button id="作成">作成</button>&nbsp;<button id="削除">削除</button>
    <hr>
    <table cellpadding="5" width="800" border>
        <tr>
            <th width="50"></th>
            <th width="100">日付</th>
            <th width="100">画像</th>
            <th>日記</th>
        </tr>
        <!-- 動的に生成する -->
    </table>
    
    
</center>
<script src="/js/diary_list/index.js?{{date("YmdHis")}}"></script>
@endsection


