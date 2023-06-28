<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

use \App\Models\Diary;

class IchiranController extends Controller
{
    private $diary;
    
    public function __construct(Diary $diary)
    {
        $this->diary = $diary;
    }
    
    public function index(): View
    {
        
        return view('ichiran.index', []);
    }
    
    public function 表示(Request $request)
    {   
        $日記一覧 = $this->diary->selectAll();
        
        $grid_data = array();
        foreach ($日記一覧 as $i => $obj) {
            // データ行
            $grid_row_data = array();
            $grid_row_data[] = $obj->path;
            $grid_row_data[] = $obj->date;
            $grid_row_data[] = $obj->contents;
            
            $grid_data[] = array('id' => $obj->id, 'data' => $grid_row_data);
        }
        
        $data = array('rows' => $grid_data);

        $ret['data'] = $data;
        return json_encode($ret);
    }

    
}
