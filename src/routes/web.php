<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemDetailController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellController;

// use App\Http\Controllers\Auth\LoginController;
// use Laravel\Fortify\Fortify;

// Fortify::ignoreRoutes();

// Route::post('/login', [LoginController::class, 'store']);

Route::get('/', [ItemController::class,'index']);
Route::get('/item/{itemId}', [ItemDetailController::class,'detail']);

Route::middleware('auth')->group(function () {

  Route::post('/item/{itemId}', [ItemDetailController::class,'setFavoritOrComment']);
  
  Route::get('/purchase/{itemId}', [PurchaseController::class,'index']);
  Route::post('/purchase/{itemId}', [PurchaseController::class,'buy']);

  Route::get('/purchase/address/{itemId}', [ProfileController::class,'indexAddress']);
  Route::patch('/purchase/address/{itemId}', [ProfileController::class,'updateAddress']);

  Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage');
  Route::post('/mypage/profile', [ProfileController::class, 'store'])->name('store');
  Route::patch('/mypage/profile', [ProfileController::class, 'update'])->name('updata');
  Route::get('/mypage/profile', [ProfileController::class, 'index'])->name('prof');

  Route::get('/sell', [SellController::class, 'index'] );
  Route::post('/sell', [SellController::class, 'store'] );

});

