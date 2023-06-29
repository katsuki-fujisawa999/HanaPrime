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
    const FILE_DIR = '/public/画像';
    
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
            
            // jpgファイルが存在するかの確認
            if (!$request->hasFile('画像')) {
                throw new Exception('画像ファイルの取得に失敗しました。');
            }
            
            // 拡張子がjpgであるかの確認
            if ($request->画像->getClientOriginalExtension() !== "jpg"
                && $request->画像->getClientOriginalExtension() !== "JPG"
                && $request->画像->getClientOriginalExtension() !== "jpeg"
                && $request->画像->getClientOriginalExtension() !== "JPEG") {
                throw new Exception('拡張子がjpg、JPG、jpeg、JPEGのいずれでもありません！');
            }
            
            // ファイルの保存
            $元ファイル名 = $request->画像->getClientOriginalName();
            $ファイル名部分 = explode(".", $元ファイル名)[0];
            $拡張子 = explode(".", $元ファイル名)[1];
            $新ファイル名 = $ファイル名部分 . '_' . date("YmdHis") . '.' . $拡張子;
            $request->画像->storeAs($this::FILE_DIR, $新ファイル名);

            $image_path = $新ファイル名;
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
