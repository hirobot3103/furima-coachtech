<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Profile;
use App\Models\Order_list;

class PurchaseController extends Controller
{
    public function index(int $itemId)
    {
        $itemData = Item::where('id', $itemId)->first();
        $profileData = Profile::where('user_id', Auth::user()->id )->first();

        return view( 'purchase', compact('itemData', 'profileData'));
    }

    public function buy(Request $request, int $itemId)
    {
        $itemParam = ['soldout' => 1];
        Item::where('id', $itemId)->update($itemParam);
        
        $param = [
          'user_id'         => Auth::user()->id,
          'item_id'         => $itemId,
          'purchase_method' => $request->purchase_method,
          'price'           => $request->price,
          'post_number'     => $request->post_number,
          'address'         => $request->address, 
          'building'        => $request->building,
        ];
        Order_list::insert($param);

        // $url = "https://www.strip.com";
        // return redirect()->away($url);
        return redirect('/mypage?tag=buy');
    }
}
