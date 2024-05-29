<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\HelloController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\RegistrationController;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/hello', [HelloController::class, 'index']);

// Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ログイン処理
Auth::routes();

Route::group(['middleware' => 'auth'], function(){

    Route::get('/', [DisplayController::class, 'index'])->name('transactions.search');

    //spend
    Route::group(['middleware' => 'can:view,spending'], function(){
        Route::get('/spend/{spending}/detail',[DisplayController::class,'spendDetail'])->name('spend.detail');
        Route::get('/edit_spend/{spending}', [RegistrationController::class, 'editSpendForm'])->name('edit.spend');
    });

    //income
    Route::group(['middleware' => 'can:view,income'], function(){
        Route::get('/income/{income}/detail',[DisplayController::class,'incomeDetail'])->name('income.detail');
        Route::get('/edit_income/{income}', [RegistrationController::class, 'editIncomeForm'])->name('edit.income');
    });

    Route::get('/create_spend', [RegistrationController::class, 'createSpendForm'])->name('create.spend');
    Route::post('/create_spend', [RegistrationController::class, 'createSpend']);

    Route::get('/create_income', [RegistrationController::class, 'createIncomeForm'])->name('create.income');
    Route::post('/create_income', [RegistrationController::class, 'createIncome']);

    // カテゴリー新規入力ページ
    Route::get('/create_type_form/{category}', [RegistrationController::class, 'createTypeForm'])->name('create.Type.Form');
    Route::post('/create_type', [RegistrationController::class, 'createType']);
    // カテゴリー追加処理ページ
    Route::post('/add_type/{category}', [RegistrationController::class, 'addType'])->name('addType');

    // データ編集ページ

    Route::post('/edit_spend/{id}', [RegistrationController::class, 'editSpend']);

    
    Route::post('/edit_income/{id}', [RegistrationController::class, 'editIncome']);

    // データ物理削除ページ
    Route::post('/delete_spend/{id}', [RegistrationController::class, 'deleteSpend'])->name('delete.spend');
    Route::post('/delete_income/{id}', [RegistrationController::class, 'deleteIncome'])->name('delete.income');

    // データ論理削除ページ
    Route::post('/soft_delete_spend/{id}', [RegistrationController::class, 'SoftDeleteSpend'])->name('softdelete.spend');
    Route::post('/soft_delete_income/{id}', [RegistrationController::class, 'SoftDeleteIncome'])->name('softdelete.income');

});
