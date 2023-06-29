$(function(){
    // 新規投稿ボタン押下
    $("#新規投稿").on( "click", function() {
        新規投稿();
    });
    
    // 編集ボタン押下
    $("#編集").on( "click", function() {
        編集(this.value);
    });
    
    // 削除ボタン押下
    $("#削除").on( "click", function() {
        削除();
    });
    
    // 全チェック
    $("#全チェック").on( "click", function() {
        if ($("#全チェック").prop("checked")){
            // 画面に表示中のチェックボックスをすべてチェックする。
            $('input[name="削除チェック[]"]').each(function(index, element) {
                $(element).prop("checked",true);
            });
        } else {
            // 画面に表示中のチェックボックスのチェックを外す。
            $('input[name="削除チェック[]"]').each(function(index, element) {
                $(element).prop("checked",false);
            });
        }
            
    });
});

function 新規投稿(){
    $("#新規投稿form").submit();
}

function 編集(id){
    $("#編集form").attr('action', "/regist_diary/index/" + id);
    $("#編集form").submit();
}

function 削除(){
    var result = window.confirm('選択した日記を削除しますか？');
    if (result){
        $("#削除form").submit();
    }
}

