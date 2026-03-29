<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoneyRecordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChoreRecordController;

Route::get('/', function () {
    return view('welcome');
});

// URL:money-recordsにgetでアクセスをしてMoneyRecordController の index メソッドを実行する。ルート名は money-records.index
Route::get('/money-records', [MoneyRecordController::class, 'index'])->name('money-records.index');
// 登録画面を表示する
Route::get('/money-records/create', [MoneyRecordController::class, 'create'])->name('money-records.create');
// URL:/money-recordsにPOSTで送信されたデータを受け取る。storeメソッドで保存する
Route::post('/money-records', [MoneyRecordController::class, 'store'])->name('money-records.store');
// 編集:どのデータを編集するかIDで指定
Route::get('/money-records/{moneyRecord}/edit', [MoneyRecordController::class, 'edit'])->name('money-records.edit');
// 更新
Route::put('/money-records/{moneyRecord}', [MoneyRecordController::class, 'update'])->name('money-records.update');
// 削除機能
Route::delete('/money-records/{moneyRecord}', [MoneyRecordController::class, 'destroy'])->name('money-records.destroy');
// checkボタン
Route::patch('/money-records/{moneyRecord}/toggle-received', [MoneyRecordController::class, 'toggleReceived'])->name('money-records.toggle-received');
Route::patch('/money-records/{moneyRecord}/toggle-received-ajax', [MoneyRecordController::class, 'toggleReceivedAjax'])
    ->name('money-records.toggle-received-ajax');
// ユーザー登録
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
// お手伝いポイント
Route::get('/chore-records', [ChoreRecordController::class, 'index'])->name('chore-records.index');
Route::get('/chore-records/create', [ChoreRecordController::class, 'create'])->name('chore-records.create');
Route::post('/chore-records', [ChoreRecordController::class, 'store'])->name('chore-records.store');
// お手伝い実績の編集削除
Route::get('/chore-records/{choreRecord}/edit', [ChoreRecordController::class, 'edit'])->name('chore-records.edit');
Route::put('/chore-records/{choreRecord}', [ChoreRecordController::class, 'update'])->name('chore-records.update');
Route::delete('/chore-records/{choreRecord}', [ChoreRecordController::class, 'destroy'])->name('chore-records.destroy');
