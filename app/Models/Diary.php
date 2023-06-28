<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    public function selectAll()
    {
        $sql = "
        select
                D.*
            from
                diaries D
            order by
                D.upload_date DESC
        ";
        $一覧 = DB::select($sql, []);
        return $一覧;
    }
    
    public function 挿入($社内品番, $得意先品番, $収容数, $梱包材ＣＤ, $備考, $製品分類名称)
    {
        $create = DB::insert("
        insert into trad.品目マスタ (社内品番, 得意先品番, 収容数, 梱包材ＣＤ, 備考, 製品分類名称) 
                values (?, ?, ?, ?, ?, ?)
        "
       , [$社内品番, $得意先品番, $収容数, $梱包材ＣＤ, $備考, $製品分類名称]);
        return $create;
    }
    
    public function 更新($arr項目, $arr条件){
        $sql = 'update trad.品目マスタ set ';
        foreach ($arr項目 as $項目 => $value) {
            $sql .= "{$項目} = '{$value}' ,";
        }
        $sql = rtrim($sql, ',');    // 最後のカンマを削除
        if (!empty($arr条件)){
            $sql .= " where 1=1";
            foreach ($arr条件 as $項目 => $value) {
                $sql .= " and {$項目} = '{$value}'";
            }
        }
        
        DB::update($sql);
    }
    
    public function 削除($id)
    {
        DB::delete('delete from trad.品目マスタ where id = ?', [$id]);
    }
    
    
    
    
}
