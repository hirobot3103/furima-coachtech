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

        $profQuery = Profile::where( 'user_id' , Auth::user()->id );

        // プロフィールが未登録の場合に登録画面へ遷移
        if( !empty( Auth::user() ) )
        {
            $query = Profile::where( 'user_id' , Auth::user()->id );
            $profData = $query->first();
            if (!empty( $profData ) && $profData['prof_reg'] == 0 )
            {
                return redirect( '/mypage/profile' );            
            }
        }

        $urlData = [
            'tag'         => 0,
            'locationUrl' => "/mypage",
            'keyword'     => "",
        ];

        $profileData = $profQuery->first();

        if ( $request->has('tag') && $request->tag == 'sell')
        {
            $query = Item::where('user_id', Auth::user()->id );

            $urlData['tag'] = 1;
            $urlData['locationUrl'] = "/mypage?tag=" . $request->tag;

            if ($request->has('keyword')) {
                $urlData['keyword'] = $request->keyword;    
                $query = $query->KeySearch($request->keyword);
            } 
    
            $itemData = $query->get();
            return view( 'auth.profsell', compact('itemData', 'profileData', 'urlData') );        
        }

        $query = Order_list::where('user_id', Auth::user()->id )->where('order_state', '!=', '0');
        $purchaseDatas = $query->get();
  
        $whereIn[] = 0;
        foreach($purchaseDatas as $item )
        {
            $whereIn[] = $item['item_id'];
        }

        $query = Item::whereIn('id', $whereIn);

        $urlData['tag'] = 2;
        $urlData['locationUrl'] = "/mypage?tag=buy";

        if ($request->has('keyword')) {
            $urlData['keyword'] = $request->keyword;
            $query = $query->KeySearch($request->keyword);
        } 

        $itemData = $query->get();

        return view( 'auth.profsell', compact('itemData', 'profileData', 'urlData') );
    }
}
