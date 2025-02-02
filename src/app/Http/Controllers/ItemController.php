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

            if ( empty( Auth::user() )) 
            {
                return redirect('/login');
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
        } else {
            $itemData = Item::where('user_id', '!=', Auth::user()->id)->get();
        }
        
        return view( 'index' , compact( 'itemData' ) );
    }
}
