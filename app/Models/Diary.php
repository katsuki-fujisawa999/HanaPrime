<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    public function selectById($id)
    {
        $sql = "
        select
                D.*
            from
                diaries as D
            where
                D.id = ?
        ";
        $一覧 = DB::select($sql, [$id]);
        return $一覧;
    }
    
    public function 挿入($upload_date, $image_path, $contents)
    {
        $create = DB::insert("
        insert into diaries (upload_date, image_path, contents) 
                values (?, ?, ?)
        "
       , [$upload_date, $image_path, $contents]);
        return $create;
    }
    
    public function 更新($upload_date, $image_path, $contents, $id){
        $sql = '
        update
            diaries
            set
                upload_date = ?
                , image_path = ?
                , contents = ?
            where
                id = ?
        ';
        
        DB::update($sql, [$upload_date, $image_path, $contents, $id]);
    }
    
    public function 更新_画像変更なし($upload_date, $contents, $id){
        $sql = '
        update
            diaries
            set
                upload_date = ?
                , contents = ?
            where
                id = ?
        ';
        
        DB::update($sql, [$upload_date, $contents, $id]);
    }
    
    public function 削除($id)
    {
        DB::delete('delete from diaries where id = ?', [$id]);
    }
}
