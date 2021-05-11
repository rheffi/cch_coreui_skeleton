<?php

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
Auth::routes();


Route::group(['middleware' => ['auth']], function () {
    Route::get('phpinfo',function(){phpinfo();});
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //**************** it ********************
    //메뉴
    Route::get('/menus', [App\Http\Controllers\it\MenuController::class, 'index'])->name('menus.index');
    Route::get('/menus/create', [App\Http\Controllers\it\MenuController::class, 'create'])->name('menus.create');
    Route::post('/menus', [App\Http\Controllers\it\MenuController::class, 'store'])->name('menus.store');
    Route::get('/menus/{menu}', [App\Http\Controllers\it\MenuController::class, 'edit'])->name('menus.edit');
    Route::put('/menus/{menu}', [App\Http\Controllers\it\MenuController::class, 'update'])->name('menus.update');
    Route::post('/menus/{menu}', [App\Http\Controllers\it\MenuController::class, 'copy'])->name('menus.copy');
    Route::put('/menus/{menu}/dnd', [App\Http\Controllers\it\MenuController::class, 'dnd'])->name('menus.dnd');
    Route::delete('/menus/{menu}', [App\Http\Controllers\it\MenuController::class, 'destroy'])->name('menus.delete');

});
