<?php

use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[AuthController::class, 'loginPage']);
Route::post('login', [AuthController::class, 'login']);
Route::get('/logout', function () {
    Auth::logout();
    return Redirect::to('/');
});
Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'IsAdminSuperAdminAgent'], function () {
        Route::get('manage',[MainController::class,'manage']);
        Route::get('details/{id}',[MainController::class,'details']);
        Route::post('updateImmoData',[MainController::class,'updateImmoData']);
    });
    Route::group(['middleware' => 'isAdminSuperAdminExternal'], function () {
        Route::get('export',[MainController::class,'exportPage']);
        Route::get('region',[MainController::class,'region']);
        Route::post('/exportXls',[MainController::class,'exportXls']);
        Route::post('savePlzUser',[MainController::class,'savePlzUser']);
    });
    Route::group(['middleware' => 'isAdminSuperAdmin'], function () {
        Route::get('admin',[MainController::class,'adminPage']);
        Route::post('updateHistory',[MainController::class,'updateHistory']);
        Route::get('report',[MainController::class,'report']);
    });
    Route::group(['middleware' => 'IsSuperAdminCC'], function () {
        Route::get('/home', [MainController::class,'home']);
        Route::get('/history', [MainController::class,'history']);
        Route::post('saveImmoData',[MainController::class,'saveData']);
        Route::get('/call/{id}', [MainController::class,'call']);
        Route::post('searchCall',[MainController::class,'searchCall']);
        
    });
    Route::group(['middleware' => 'IsSuperAdmin'], function () {
        Route::get('plzgroup',[MainController::class,'plzgroup']);
        Route::post('savePgMember',[MainController::class,'savePgMember']);
        Route::post('refreshAddresses',[MainController::class,'refreshAddresses']);
        Route::post('recoverAddresses',[MainController::class,'recoverAddresses']);
        Route::post('delPgMember',[MainController::class,'delPgMember']);
    });
    
    Route::get('/checkPhonePage',[MainController::class,'checkPhonePage']);
    Route::post('checkPhoneNumber',[MainController::class,'checkPhoneNumber']);
    Route::post('insertImmoData',[MainController::class,'insertImmoData']);
    
});