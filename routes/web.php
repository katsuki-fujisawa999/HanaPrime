<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\IchiranController;

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
Route::get('/', [IchiranController::class, 'index']);
Route::get('/ichiran/表示', [IchiranController::class, '表示']);