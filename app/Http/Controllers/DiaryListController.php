<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

use \App\Models\Diary;

class DiaryListController extends Controller
{
    private $diary;
    
    public function __construct(Diary $diary)
    {
        $this->diary = $diary;
    }
    
    public function index(): View
    {
        return view('diary_list.index', [
            'diaries' => DB::table('diaries')->paginate(5)
        ]);
    }
    
    public function 表示(Request $request)
    {  
        try {
            $日記一覧 = $this->diary::paginate(10);

            $表data = array();
            foreach ($日記一覧 as $i => $obj) {
                // データ行
                $行data = array();
                $行data[] = $obj->upload_date;
                $行data[] = $obj->image_path;
                $行data[] = $obj->contents;

                $表data[] = array('id' => $obj->id, 'data' => $行data);
            }
            
            $ret['message'] = '';
            $ret['data'] = $表data;
            return json_encode($ret);
        } catch (Exception $ex) {
            Log::error($ex->getMessage() . "\n" . $ex->getTraceAsString());
            $ret['message'] = $ex->getMessage() . "\n" . $ex->getTraceAsString();
            $ret['data'] = array();
        }
            
    }
  
}
