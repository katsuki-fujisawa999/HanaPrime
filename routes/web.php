<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DiaryListController;
use App\Http\Controllers\RegistDiaryController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// 一覧ページ
Route::get('/', [DiaryListController::class, 'index']);
Route::get('/diary_list/index', [DiaryListController::class, 'index'])->name('dairy_list.index');
Route::get('/diary_list/getImage/{ファイル名?}', [DiaryListController::class, 'getImage']);
Route::get('/diary_list/削除', [DiaryListController::class, '削除']);

// 新規投稿ページ/編集ページ
Route::get('/regist_diary/index/{id?}', [RegistDiaryController::class, 'index']);
Route::post('/regist_diary/保存', [RegistDiaryController::class, '保存']);
