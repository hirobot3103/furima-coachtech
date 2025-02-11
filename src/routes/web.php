<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ItemDetailController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellController;

Route::get('/', [ItemController::class,'index']);
Route::get('/item/{itemId}', [ItemDetailController::class,'detail']);

Route::middleware('auth')->group(function () {

  // メール認証必須のルート
  Route::middleware('verified')->group(function () {

    // 商品詳細画面　いいねボタン押下、コメント送信時
    Route::post('/item/{itemId}', [ItemDetailController::class,'setFavoritOrComment']);
    
    Route::get('/purchase/{itemId}', [PurchaseController::class,'index']);
    Route::post('/purchase/{itemId}', [PurchaseController::class,'buy']);

    Route::get('/purchase/address/{itemId}', [ProfileController::class,'indexAddress']);
    Route::patch('/purchase/address/{itemId}', [ProfileController::class,'updateAddress']);

    Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage');
    Route::post('/mypage/profile', [ProfileController::class, 'store'])->name('store');
    Route::patch('/mypage/profile', [ProfileController::class, 'update'])->name('updata');
    Route::get('/mypage/profile', [ProfileController::class, 'index'])->name('prof');

    Route::get('/sell', [SellController::class, 'index'] )->name('sellindex');
    Route::post('/sell', [SellController::class, 'store'] )->name('sellstore');

  });
});
