<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemDetailController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', [ItemController::class,'index']);
Route::get('/item/{itemId}', [ItemDetailController::class,'detail']);

Route::middleware('auth')->group(function () {

  Route::post('/item/{itemId}', [ItemDetailController::class,'setFavoritCount']);
  
  Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage');
  Route::post('/mypage/profile', [ProfileController::class, 'store'])->name('store');
  Route::get('/mypage/profile', [ProfileController::class, 'index'])->name('index');

// Route::view('/mypage/profile', 'auth.edit-prof');
//   Route::get('/admin/search', [AuthController::class, 'search'])->name('search');
//   Route::post('/admin/delete', [AuthController::class, 'delete'])->name('delete');
//   Route::post('/admin/csv', [AuthController::class, 'export'])->name('export');
});

