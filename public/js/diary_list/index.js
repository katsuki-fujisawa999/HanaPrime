$(function(){

    表示();

    // 新規投稿ボタン押下
    $("#新規投稿").on( "click", function() {
        新規投稿();
    });
    
    

    
});

function 新規投稿(){
    $("#新規投稿form").submit();
}

function 表示(){
    
    // マスク開始。
    $("#overlay").fadeIn(300);
    
    $.ajax({
        url: '/diary_list/表示',
        type: 'GET',
        dataType: 'json',
        data: {
        }
    }).done(function (response) {
        

        // マスク停止。
        $("#overlay").fadeOut(300);        
    }).fail(function (jqXHR, textStatus, errorThrown) {
        // マスク停止。
        $("#overlay").fadeOut(300);
    });
}


