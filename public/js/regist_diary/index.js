$(function(){
    // 保存ボタン押下
    $("#保存").on( "click", function() {
        保存();
    });
});

function 保存(){
    $("#保存form").submit();
}

