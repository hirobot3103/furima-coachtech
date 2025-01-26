<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Favorit;

class ItemDetailController extends Controller
{
    public function detail( int $item_id )
    {
        // 商品詳細情報を取得
        $item_datas = Item::with('status_list')->get();
        $item_data = $item_datas[ $item_id - 1 ];

        // いいね関係を取得
        $favorit_datas = Favorit::where('item_id', $item_id);
        if( empty($favorit_datas) ) {
            $favorit_count = 0;
        } else {
            $favorit_count = $favorit_datas->count();

        }
        
        // コメント関係を取得

        return view('detail', compact('item_data', 'favorit_data') );
    }
}
