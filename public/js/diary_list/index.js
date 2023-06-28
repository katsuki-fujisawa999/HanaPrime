$(function(){
    // 新規投稿ボタン押下
    $("#新規投稿").on( "click", function() {
        新規投稿();
    });
});

function 新規投稿(){
    $("#新規投稿form").submit();
}



