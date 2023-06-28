<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DiaryListController;

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
Route::get('/diary_list/表示', [DiaryListController::class, '表示']);

// 新規投稿ページ
Route::get('/regist_diary', [IchiranController::class, 'index']);
Route::get('/ichiran/表示', [IchiranController::class, '表示']);