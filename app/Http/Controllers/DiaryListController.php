<?php

namespace App\Http\Controllers;

use Exception;
use Storage;
use Log;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

use \App\Models\Diary;

class DiaryListController extends Controller
{
    const FILE_DIR = '/public/画像';
    const NO_IMAGE_NAME = 'noimage.jpg';
    
    private $diary;
    
    public function __construct(Diary $diary)
    {
        $this->diary = $diary;
    }
    
    public function index(): View
    {
        return view('diary_list.index', [
            'diaries' => DB::table('diaries')->orderBy('upload_date', 'desc')->orderBy('id', 'desc')->paginate(5)
            , 'FILE_DIR' => Storage::disk('local')->get($this::FILE_DIR)
        ]);
    }
    
    public function getImage($ファイル名 = null)
    {
        if (empty($ファイル名)){
            // 空の画像を返す。
            $ファイル名 = $this::NO_IMAGE_NAME;
        }
        
        $ファイルパス = $this::FILE_DIR . '/' . $ファイル名;
        $画像 = Storage::disk('local')->get($ファイルパス);
        header('Content-Type: image/png');  // コンテンツの種類を返す
        header('Content-Length: ' . strlen($画像));  // コンテンツの長さを返す
        echo $画像;  // 画像データを出力する        
    }
    
    public function 削除(Request $request)
    {  
        try {
            DB::beginTransaction();
            $削除チェック = $request->input('削除チェック');
            
            foreach ($削除チェック as $i => $id) {
                $this->diary->削除($id);
            }
            
            DB::commit();

            return redirect()->route('dairy_list.index');
        } catch (Exception $ex) {
            DB::rollBack();
            Log::error($ex->getMessage() . "\n" . $ex->getTraceAsString());
            return redirect()->route('dairy_list.index');
        }
            
    }
  
}
