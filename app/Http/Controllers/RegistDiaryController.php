<?php

namespace App\Http\Controllers;

use Exception;
use Log;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

use \App\Models\Diary;

class RegistDiaryController extends Controller
{
    private $diary;
    
    public function __construct(Diary $diary)
    {
        $this->diary = $diary;
    }
    
    public function index(): View
    {
        // 日付の初期値は本日の日付とする。
        $日付の初期値 = date("Y-m-d");
        return view('regist_diary.index', [
            "日付の初期値" => $日付の初期値
        ]);
    }
    
    public function 保存(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $tmp日付 = $request->input('日付');
            $日記 = $request->input('日記');
            
            $tmp = explode('-', $tmp日付);
            $日付 = $tmp[0] . $tmp[1] . $tmp[2];
            
            $image_path = '';
            $contents = $日記;
            $this->diary->挿入($日付, $image_path, $contents);

            DB::commit();

            return redirect()->route('dairy_list.index');
        } catch (Exception $exc) {
            DB::rollBack();
            Log::error($exc->getMessage() . "\n" . $exc->getTraceAsString());
            return redirect()->route('dairy_list.index');
        }   
    }

    
}
