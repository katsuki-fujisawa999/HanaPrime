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
