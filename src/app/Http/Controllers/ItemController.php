<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Profile;

class ItemController extends Controller
{
    public function index()
    {

        // プロフィールが未登録の場合に登録画面へ遷移
        if( !empty( Auth::user() ) && empty( Profile::where( 'user_id' , Auth::user()->id )->first() ) )
        {
            return redirect( '/mypage/profile' );
        }

        $itemData = Item::All();
        
        return view( 'index' , compact( 'itemData' ) );
    }
}
