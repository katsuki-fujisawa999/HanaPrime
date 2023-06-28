$(function(){
    // 新規投稿ボタン押下
    $("#新規投稿").on( "click", function() {
        新規投稿();
    });
    
    // 削除ボタン押下
    $("#削除").on( "click", function() {
        削除();
    });
    
    
});

function 新規投稿(){
    $("#新規投稿form").submit();
}

function 削除(){
    var result = window.confirm('選択した日記を削除しますか？');
    if (result){
        $("#削除form").submit();
    }
}

