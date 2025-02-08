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

        $keyword = "";
        $urlData = [];

        // mylist選択時
        if ( $request->has('tag') && $request->tag == 'mylist' )
        {

            $urlData = [
                'locationUrl' => "/?tag=" . $request->tag,
            ];

            // 未認証の場合は何も表示しない
            if ( empty( Auth::user() )) 
            {
                $itemData = [];
                session()->flash('message', $keyword);                
                return view( 'mylist' , compact('itemData', 'urlData'));
            }

            
            $favoritItems = Favorit::where('user_id', Auth::user()->id )->get();
            $whereIn[] = 0;
            foreach($favoritItems as $item )
            {
                $whereIn[] = $item['item_id'];
            }
            if ($request->has('keyword')){
                $keyword = $request->keyword;
                $itemData = Item::whereIn('id', $whereIn)->KeySearch($keyword)->get();
            } else {
                $itemData = Item::whereIn('id', $whereIn)->get();            
            }

            session()->flash('message', $keyword);
            return view( 'mylist' , compact('itemData', 'urlData'));
        }


        // 商品一覧表示
        $urlData = [
            'locationUrl' => "/",
        ];

        if ( empty( Auth::user() ) ){
            if ($request->has('keyword')){
                $keyword = $request->keyword;
                $itemData = Item::KeySearch($keyword)->get();
            } else {
                $itemData = Item::all();
            }
            session()->flash('message', $keyword);
            return view( 'index' , compact('itemData', 'urlData'));
        }

        if ($request->has('keyword')){

            $keyword = $request->keyword;
            $itemData = Item::where('user_id', '!=', Auth::user()->id)->KeySearch($keyword)->get();
        } else {
            $itemData = Item::where('user_id', '!=', Auth::user()->id)->get();

        }

        session()->flash('message', $keyword);
        return view( 'index' , compact('itemData', 'urlData'));
    }
}
