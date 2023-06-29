$(function(){
    // 保存ボタン押下
    $("#保存").on( "click", function() {
        保存();
    });
});

function 保存(){
    var 日付 = $("#日付").val();
    if (日付 === ""){
        alert("日付を入力してください！");
        return false;
    }
    
    var ファイル = $("#画像").val();
    if (ファイル !== ""){
        // 拡張子がjpgまたはJPGまたはjpeg、JPEGかどうかチェックする。
        var tmp = ファイル.split('.');
        if (tmp.length < 2){
            alert("ファイル名が正しくありません！");
            return false;
        }

        if (tmp[tmp.length-1] !== "jpg"
                && tmp[tmp.length-1] !== "JPG"
                && tmp[tmp.length-1] !== "jpeg"
                && tmp[tmp.length-1] !== "JPEG"){
            alert("拡張子がjpg、JPG、jpeg、JPEGのいずれでもありません！");
            return false;
        }
    }
    
    var 日記 = $("#日記").val();
    if (日記 === ""){
        alert("日記を入力してください！");
        return false;
    }
    
    if (日記.length > 256){
        alert("日記の長さは256文字以内にしてください！");
        return false;
    }
    
    $("#保存form").submit();
}

