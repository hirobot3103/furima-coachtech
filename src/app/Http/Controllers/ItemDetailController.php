<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Favorit;

class ItemDetailController extends Controller
{

    public function detail( int $itemId )
    {
        
        // 商品詳細情報を取得
        $itemDatas = Item::with( 'status_list' )->get();
        $itemData = $itemDatas[ $itemId - 1 ];


        // いいねの総数と、ログインユーザーがいいねをした商品かを取得
        $favoritCount = 0;
        $myFavoritCount = 0;

        $favoritDatas = Favorit::where( 'item_id', $itemId );

        if ( !empty( $favoritDatas ) )
        {
            $favoritCount = $favoritDatas->count();
        }

        if ( !empty( Auth::user() ) )
        {
            $myFavoritItem = $favoritDatas->where( 'user_id', Auth::user()->id )->first();

            if ( !empty( $myFavoritItem ) && ( $itemId == $myFavoritItem['item_id'] ) )
            {
                $myFavoritCount = 1;
            }
        }

        $favoritData = [
          'count' => $favoritCount,
          'myfavorit' => $myFavoritCount,  
        ];
        
        // コメント関係を取得

        return view( 'detail' , compact( 'itemData' , 'favoritData' ) );
    }

    public function setFavoritCount(Request $request, int $ItemId)
    {
        if( $request->has('myfavorit') ) {
            
            if( $request->myfavoritFlg > 0 ) {
                
                // いいねを解除
                Favorit::where( 'item_id',  $ItemId )->where( 'user_id', Auth::user()->id )->delete();

            } else {
            
                // いいねを追加
                $favoritTable = new Favorit;
                $favoritTable->user_id = Auth::user()->id;
                $favoritTable->item_id = $ItemId; 
                $favoritTable->save();

            }

            return redirect('/item/' . $ItemId );
        }
    }
}
