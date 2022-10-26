<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SheelController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//ユーザー登録、認証部分の読み込み
require __DIR__.'/auth.php';

//トップ画面
Route::get('top', [SheelController::class, 'showTop'])->name('top');
Route::post('top', [SheelController::class, 'showTopSearch'])->name('topSearch');

//施設一覧画面
Route::get('institutionList', [SheelController::class, 'showInstitutionList'])->name('institutionList');
Route::post('institutionList', [SheelController::class, 'showInstitutionSearch'])->name('institutionSearch');
//施設詳細画面表示
Route::get('institution', [SheelController::class, 'showInstitution'])->name('institution');

//利用者新規登録画面
Route::get('tenantRegister', [SheelController::class, 'showTenantRegister'])->name('tenantRegister');
Route::post('tenantRegister', [SheelController::class, 'exeTenantRagister']);
//利用者詳細
Route::get('tenant', [SheelController::class, 'showTenant'])->name('tenant');
Route::post('tenant', [SheelController::class, 'showConditionSearch'])->name('conditionSearch');

//体調登録
Route::get('conditionRegister', [SheelController::class, 'showConditionRegister'])->name('conditionRegister');
Route::post('conditionRegister', [SheelController::class, 'exeConditionRegister']);

//ajax処理
Route::get('ajaxConditionRegister/', [SheelController::class,'ajaxConditionRegister'])->name('ajaxConditionRegister');
//戻るメソッド
Route::get('back', [SheelController::class, 'back'])->name('back');
//体調リセット
Route::get('resetCondition', [SheelController::class, 'resetCondition'])->name('resetCondition');
//////////////////////////管理者権限/////////////////////////////
//管理者トップ画面
Route::get('adminTop', [SheelController::class, 'showAdminTop'])->name('adminTop');
//管理者検索トップ画面
Route::post('adminTop', [SheelController::class, 'showAdminTopSearch'])->name('adminTopSearch');

//管理者施設一覧画面
Route::get('adminInstitutionList', [SheelController::class, 'showAdminInstitutionList'])->name('adminInstitutionList');
//管理者施設検索画面表示
Route::post('adminInstitutionList', [SheelController::class, 'showAdminInstitutionListSearch'])->name('adminInstitutionListSearch');
//管理者施設登録画面表示
Route::get('institutionRegister', [SheelController::class, 'showInstitutionRagister'])->name('institutionRegister');
//管理者施設登録処理
Route::post('institutionRegister', [SheelController::class, 'exeInstitutionRagister']);
//管理者施設詳細画面表示
Route::get('adminInstitution', [SheelController::class, 'showAdminInstitution'])->name('adminInstitution');
//管理者施設削除
Route::get('institutionDelete', [SheelController::class, 'exeInstitutionDelete'])->name('institutionDelete');

//利用者新規登録画面
Route::get('adminTenantRegister', [SheelController::class, 'showAdminTenantRegister'])->name('adminTenantRegister');
Route::post('adminTenantRegister', [SheelController::class, 'exeAdminTenantRagister']);
//利用者詳細画面
Route::get('adminTtenant', [SheelController::class, 'showAdminTenant'])->name('adminTenant');
Route::post('adminTtenant', [SheelController::class, 'showAdminConditionSearch'])->name('adminConditionSearch');

//利用者編集
Route::get('tenantUpdate', [SheelController::class, 'showTenantUpdate'])->name('tenantUpdate');
Route::post('tenantUpdate', [SheelController::class, 'exeTenantUpdate']);
//利用者削除
Route::get('tenantDelete', [SheelController::class, 'exeTenantDelete'])->name('tenantDelete');

//施設従業員一覧
Route::get('userList', [SheelController::class, 'showUserList'])->name('userList');
Route::post('userList', [SheelController::class, 'showUserListSearch'])->name('userListSearch');
//従業員編集
Route::get('userUpdate', [SheelController::class, 'showUserUpdate'])->name('userUpdate');
Route::post('userUpdate', [SheelController::class, 'exeUserUpdate']);
//従業員削除画面
Route::get('user', [SheelController::class, 'showUser'])->name('user');
//従業員削除
Route::get('userDelete', [SheelController::class, 'exeUserDelete'])->name('userDelete');
