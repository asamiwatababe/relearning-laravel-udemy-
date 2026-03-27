<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoneyRecordController;

Route::get('/', function () {
    return view('welcome');
});

// URL:money-recordsにgetでアクセスをしてMoneyRecordController の index メソッドを実行する。ルート名は money-records.index
Route::get('/money-records', [MoneyRecordController::class, 'index'])->name('money-records.index');
// 登録画面を表示する
Route::get('/money-records/create', [MoneyRecordController::class, 'create'])->name('money-records.create');
// URL:/money-recordsにPOSTで送信されたデータを受け取る。storeメソッドで保存する
Route::post('/money-records', [MoneyRecordController::class, 'store'])->name('money-records.store');
