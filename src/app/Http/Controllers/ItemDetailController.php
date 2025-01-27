<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Favorit;

class ItemDetailController extends Controller
{
    public function detail( int $item_id )
    {
        
        // 商品詳細情報を取得
        $item_datas = Item::with('status_list')->get();
        $item_data = $item_datas[ $item_id - 1 ];

        // いいねの総数と、ログインユーザーがいいねをした商品かを取得
        $favorit_count = 0;
        $my_favorit_count = 0;
        $favorit_datas = Favorit::where('item_id', $item_id);
        if ( !empty($favorit_datas) ) {
            $favorit_count = $favorit_datas->count();
        }
        if ( !empty( Auth::user() ) ) {
            $my_favorit_item = Favorit::where('user_id', Auth::user()->id )->first();
            if ( !empty($my_favorit_item) && ($item_id == $my_favorit_item['item_id']) ){
                $my_favorit_count = 1;
            }
        } 
        $favorit_data = [
          'count' => $favorit_count,
          'my_favorit' => $my_favorit_count,  
        ];
        
        // コメント関係を取得

        return view('detail', compact('item_data', 'favorit_data') );
    }
}
