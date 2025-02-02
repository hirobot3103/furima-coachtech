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
        if ( !empty( Auth::user() ) && $request->has('tag') )
        {
            $favoritItems = Favorit::where('user_id', Auth::user()->id )->get();
            $whereIn[] = 0;
            foreach($favoritItems as $item )
            {
                $whereIn[] = $item['item_id'];
            }
            $itemData = Item::whereIn('id', $whereIn)->get();

            return view( 'mylist' , compact( 'itemData' ) );
        }

        $itemData = Item::All();
        
        return view( 'index' , compact( 'itemData' ) );
    }
}
