$(function(){

    表示();

    // 追加ボタン押下
    $("#追加").on( "click", function() {
        行追加();
    });
    // 削除ボタン押下
    $('#削除').on('click', function() {
        行削除();
    });

    // 保存ボタン押下
    $('#保存').on('click', function() {
        var 保存データ = 保存データ取得();

        // マスク開始
        $("#overlay").fadeIn(300);

        $.ajax({
            url: '/driver_master/保存',
            type: 'POST',
            dataType: 'json',
            data: {
                "保存データ" : 保存データ
            }
        }).done(function (response) {
            // 
            myGrid.forEachRow(function(id){
                myGrid.setRowAttribute(id, 'edited', null);
                myGrid.setRowAttribute(id, 'added', null);
                myGrid.setRowAttribute(id, 'deleted', null);
                myGrid.forEachCell(id,function(cellObj,ind){
                    cellObj.setAttribute('edited', null);
                    cellObj.setAttribute('deleted', null);
                });
                行制御(id);
            });

            表示();
            
            // マスク停止
            $("#overlay").fadeOut(300);
        }).fail(function (jqXHR, textStatus, errorThrown) {
            alert("保存が失敗しました！");
            // マスク停止
            $("#overlay").fadeOut(300);
        });
    });
});

function 表示(){
    
    // マスク開始。
    $("#overlay").fadeIn(300);
    
    $.ajax({
        url: '/ichiran/表示',
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



function 行削除(){
    var selectedRowId = myGrid.getSelectedRowId();
    
    if (!selectedRowId){
        return;
    }
    
    myGrid.setRowAttribute(selectedRowId,"deleted",true);
    行制御(selectedRowId);
}



function 保存データ取得(){
    var 追加行データ = [];
    var 削除行データ = [];
    var 編集行データ = [];
    myGrid.editStop();
    myGrid.forEachRow(function(id){
        var 追加属性 = myGrid.getRowAttribute(id, "added");
        var 編集属性 = myGrid.getRowAttribute(id, "edited");
        var 削除属性 = myGrid.getRowAttribute(id, "deleted");
        
        // 削除行をサーバーに送信する。
        // ただし、追加して削除した行は、サーバーに送信しない。
        if (削除属性){
            if (追加属性){
                // サーバー送信対象外。
            } else {
                var tmp削除行データ = {};
                tmp削除行データ["id"] = id;
                削除行データ.push(tmp削除行データ);
            }
        // 追加行をサーバーに送信する。
        } else if (追加属性){
            var tmp追加行データ = {};
            myGrid.forEachCell(id,function(cellObj,ind){
                var colId = myGrid.getColumnId(ind);
                var 項目 = colId;
                var 値 = cellObj.getValue();
                tmp追加行データ[項目] = 値;
            });
            追加行データ.push(tmp追加行データ);
        // 編集行をサーバーに送信する。
        } else if (編集属性){
            var tmp編集行データ = {};
            tmp編集行データ["id"] = id;
            myGrid.forEachCell(id,function(cellObj,ind){
                var 列編集属性 = cellObj.getAttribute("edited");
                if (列編集属性){
                    var colId = myGrid.getColumnId(ind);
                    var 項目 = colId;
                    var 値 = cellObj.getValue();
                    tmp編集行データ[項目] = 値;
                }
            });
            編集行データ.push(tmp編集行データ);
        } 
    });
    
    return {"追加行データ" : 追加行データ
        , "削除行データ" : 削除行データ
        , "編集行データ" : 編集行データ};
}








