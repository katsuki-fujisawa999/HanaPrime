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
                , D.id DESC
        ";
        $一覧 = DB::select($sql, []);
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
    
    public function 削除($id)
    {
        DB::delete('delete from diaries where id = ?', [$id]);
    }
    
    
    
    
}
