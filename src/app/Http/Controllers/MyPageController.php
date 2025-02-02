<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Profile;
use App\Models\Item;
use App\Models\Order_list;


class MyPageController extends Controller
{
    public function index(Request $request )
    {

        $profileData = Profile::where('user_id', Auth::user()->id )->first();
        
        if ( $request->has('tag') && $request->tag == 'sell')
        {
            $itemData = Item::where('user_id', Auth::user()->id )->get();
            return view( 'auth.profsell', compact('itemData', 'profileData') );        
        }

        $purchaseDatas = Order_list::where('user_id', Auth::user()->id )->get();
        $whereIn[] = 0;
        foreach($purchaseDatas as $item )
        {
            $whereIn[] = $item['item_id'];
        }
        $itemData = Item::whereIn('id', $whereIn)->get();

        return view( 'auth.prof', compact('itemData', 'profileData') );
    }
}
