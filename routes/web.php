<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\DataFormController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/create',[AreaController::class,'index'])->name('create');
Route::post('/create-data',[DataFormController::class,'index'])->name('create.form');
Route::post('/check-compare1',[DataFormController::class,'checkcompare1'])->name('checkcompare1.form');
Route::post('/check-compare2',[DataFormController::class,'checkcompare2'])->name('checkcompare2.form');
Route::post('/check-compare3',[DataFormController::class,'checkcompare3'])->name('checkcompare3.form');
Route::post('/store',[DataFormController::class,'store'])->name('store.form');


