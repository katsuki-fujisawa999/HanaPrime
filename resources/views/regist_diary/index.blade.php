@extends('layouts.layout')
@section('title','新規投稿')
@section('content')
<script>
</script>
<center>
    <form id="保存form" action="保存" name="保存form">
    <h1>新規投稿</h1>
    <table cellpadding="5" width="800" border>
        <tr>
            <th width="100">日付</th>
            <td><input type="date" id="日付" name="日付" value="{{ $日付の初期値 }}"></td>
        </tr>
        <tr>
            <th>画像（jpg）</th>
            <td><input type="file" id="画像" name="画像"></td>
        </tr>
        <tr>
            <th>日記</th>
            <td><input type="text" id="日記" name="日記" value="" style="width: 600px;padding: 5px;"></td>
        </tr>
    </table>
    <br>
    <button id="保存">保存</button>
    </from>
</center>
<script src="/js/regist_diary/index.js?{{date("YmdHis")}}"></script>
@endsection


