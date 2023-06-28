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
        return view('regist_diary.index', []);
    }
    
    public function 保存(Request $request)
    {
        try {
            DB::beginTransaction();

            DB::commit();

            return redirect()->route('dairy_list.index');
        } catch (Exception $exc) {
            DB::rollBack();
            Log::error($exc->getMessage() . "\n" . $exc->getTraceAsString());
            return redirect()->route('dairy_list.index');
        }   
    }

    
}
