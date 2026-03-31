<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MoneyRecordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ChoreRecordController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ChoreController;

Route::get('/', function () {
    return redirect()->route('money-records.index');
});

// ── 管理者ログイン（認証不要） ──────────────────────────
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

// ── 閲覧のみ（全員アクセス可） ────────────────────────
Route::get('/money-records', [MoneyRecordController::class, 'index'])->name('money-records.index');
Route::get('/chore-records', [ChoreRecordController::class, 'index'])->name('chore-records.index');
Route::get('/chores', [ChoreController::class, 'index'])->name('chores.index');

// ── 管理者のみ ────────────────────────────────────────
Route::middleware('admin')->group(function () {

    // 管理画面
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

    // ユーザー管理
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // お小遣い管理（登録・編集・削除）
    Route::get('/money-records/create', [MoneyRecordController::class, 'create'])->name('money-records.create');
    Route::post('/money-records', [MoneyRecordController::class, 'store'])->name('money-records.store');
    Route::get('/money-records/{moneyRecord}/edit', [MoneyRecordController::class, 'edit'])->name('money-records.edit');
    Route::put('/money-records/{moneyRecord}', [MoneyRecordController::class, 'update'])->name('money-records.update');
    Route::delete('/money-records/{moneyRecord}', [MoneyRecordController::class, 'destroy'])->name('money-records.destroy');
    Route::patch('/money-records/{moneyRecord}/toggle-received', [MoneyRecordController::class, 'toggleReceived'])->name('money-records.toggle-received');
    Route::patch('/money-records/{moneyRecord}/toggle-received-ajax', [MoneyRecordController::class, 'toggleReceivedAjax'])->name('money-records.toggle-received-ajax');

    // お手伝いリスト管理（登録・編集・削除）
    Route::get('/chores/create', [ChoreController::class, 'create'])->name('chores.create');
    Route::post('/chores', [ChoreController::class, 'store'])->name('chores.store');
    Route::get('/chores/{chore}/edit', [ChoreController::class, 'edit'])->name('chores.edit');
    Route::put('/chores/{chore}', [ChoreController::class, 'update'])->name('chores.update');
    Route::delete('/chores/{chore}', [ChoreController::class, 'destroy'])->name('chores.destroy');

    // お手伝い管理（登録・編集・削除）
    Route::get('/chore-records/create', [ChoreRecordController::class, 'create'])->name('chore-records.create');
    Route::post('/chore-records', [ChoreRecordController::class, 'store'])->name('chore-records.store');
    Route::get('/chore-records/{choreRecord}/edit', [ChoreRecordController::class, 'edit'])->name('chore-records.edit');
    Route::put('/chore-records/{choreRecord}', [ChoreRecordController::class, 'update'])->name('chore-records.update');
    Route::delete('/chore-records/{choreRecord}', [ChoreRecordController::class, 'destroy'])->name('chore-records.destroy');
});
