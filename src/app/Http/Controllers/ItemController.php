<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Profile;
use App\Models\Favorit;

class ItemController extends Controller
{
    public function index(Request $request)
    {

        // プロフィールが未登録の場合に登録画面へ遷移
        if( !empty( Auth::user() ) && empty( Profile::where( 'user_id' , Auth::user()->id )->first() ) )
        {
            return redirect( '/mypage/profile' );
        }


        // mylist選択時
        if ( $request->has('tag') && $request->tag == 'mylist' )
        {

            // 未認証の場合は何も表示しない
            if ( empty( Auth::user() )) 
            {
                $itemData = [];
                return view( 'mylist' , ['itemData' => $itemData]);
            }

            
            $favoritItems = Favorit::where('user_id', Auth::user()->id )->get();
            $whereIn[] = 0;
            foreach($favoritItems as $item )
            {
                $whereIn[] = $item['item_id'];
            }
            if ($request->has('keyword')){
                $itemData = Item::whereIn('id', $whereIn)->KeySearch($request->keyword)->get();
            } else {
                $itemData = Item::whereIn('id', $whereIn)->get();            
            }

            return view( 'mylist' , compact( 'itemData' ) );
        }


        // 商品一覧表示
        if ( empty( Auth::user() ) ){
            if ($request->has('keyword')){
                $itemData = Item::KeySearch($request->keyword)->get();
            } else {
                $itemData = Item::all();
            }
            return view( 'index' , compact( 'itemData' ) );
        }

        if ($request->has('keyword')){
            $itemData = Item::where('user_id', '!=', Auth::user()->id)->KeySearch($request->keyword)->get();
            $keySentence = [ 'keyword' => $request->keyword, ];
        } else {
            $itemData = Item::where('user_id', '!=', Auth::user()->id)->get();
            $keySentence = [ 'keyword' => "", ];
        }
        
        return view( 'index' , compact( 'itemData', 'keySentence' ) );
    }
}
