<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    //ログイン画面表示
    Route::get('', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    //post送信の場合はログインしダッシュボードへ
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    //新規登録ページ表示
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');
    //post送信の場合は登録処理
    Route::post('register', [RegisteredUserController::class, 'store']);

    //リセットURL送付用のメールアドレス入力ページ表示
    Route::get('reset', [PasswordResetLinkController::class, 'create'])
        ->name('reset');
    //パスワード再入力用リンク送付
    Route::post('reset', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');
    //パスワード再登録画面表示
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');
    ///パスワード再入力実行
    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.update');

    //管理者ログインページ表示
    Route::get('adminLogin', [AuthenticatedSessionController::class, 'adminCreate'])->name('adminLogin');
    //post送信の場合はログインしダッシュボードへ
    Route::post('adminLogin', [AuthenticatedSessionController::class, 'adminStore']);

    //管理者登録
    Route::get('adminRegister', [RegisteredUserController::class, 'adminCreate'])
        ->name('adminRegister');
    //post送信の場合は登録処理
    Route::post('adminRegister', [RegisteredUserController::class, 'adminStore']);
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
