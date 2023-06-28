<?php

namespace App\Http\Controllers;

use Exception;
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
    
    

    
}
