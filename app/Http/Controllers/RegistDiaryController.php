<?php

namespace App\Http\Controllers;

use Exception;
use Log;
use Storage;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

use \App\Models\Diary;

class RegistDiaryController extends Controller
{
    const FILE_DIR = '/public/画像';
    const NO_IMAGE_NAME = 'noimage.jpg';
    
    private $diary;
    
    public function __construct(Diary $diary)
    {
        $this->diary = $diary;
    }
    
    public function index($id = null): View
    {
        
        if (empty($id)){    // 新規投稿の場合
            // 日付の初期値は本日の日付とする。
            $日付= date("Y-m-d");
            
            $ファイル名 = $this::NO_IMAGE_NAME;
            $ファイルパス = $this::FILE_DIR . '/' . $ファイル名;
            $画像 = Storage::disk('local')->get($ファイルパス);
            // base64エンコード
            $data = base64_encode($画像);
            
            return view('regist_diary.index', [
                '日付' => $日付
                , '画像' => 'data:image/jpeg;base64,' . $data
                , '日記' => ''
                , 'id' => ''
            ]);
            
        } else {    // 編集の場合
            $日記 = $this->diary->selectById($id);
            $日付 = substr($日記[0]->upload_date, 0, 4) . '-' . substr($日記[0]->upload_date, 4, 2) . '-' . substr($日記[0]->upload_date, 6, 2);
            
            if (empty($日記[0]->image_path)){
                // 空の画像を返す。
                $ファイル名 = $this::NO_IMAGE_NAME;
            } else {
                $ファイル名 = $日記[0]->image_path;
            }

            $ファイルパス = $this::FILE_DIR . '/' . $ファイル名;
            $画像 = Storage::disk('local')->get($ファイルパス);
            // base64エンコード
            $data = base64_encode($画像);
            
            return view('regist_diary.index', [
                '日付' => $日付
                , '画像' => 'data:image/jpeg;base64,' . $data
                , '日記' => $日記[0]->contents
                , 'id' => $日記[0]->id
            ]);
        }
    }
    
    public function 保存(Request $request)
    {
        try {
            DB::beginTransaction();
            
            $id = $request->input('id');
            
            $tmp日付 = $request->input('日付');
            $日記 = $request->input('日記');
            
            $tmp = explode('-', $tmp日付);
            $日付 = $tmp[0] . $tmp[1] . $tmp[2];
            
            // jpgファイルが存在するかの確認
            if ($request->hasFile('画像')) {
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
            } else {
                $image_path = '';
            }
            
            if (empty($id)){    // 新規投稿の場合
                $this->diary->挿入($日付, $image_path, $日記);
            } else {    // 編集の場合
                if (empty($image_path)){  // 画像の変更なしの場合   
                    $this->diary->更新_画像変更なし($日付, $日記, $id);
                } else {    // 画像の変更ありの場合
                    $this->diary->更新($日付, $image_path, $日記, $id);
                }
            }
            
            DB::commit();

            return redirect()->route('dairy_list.index');
        } catch (Exception $exc) {
            DB::rollBack();
            Log::error($exc->getMessage() . "\n" . $exc->getTraceAsString());
            return redirect()->route('dairy_list.index');
        }   
    }
}
