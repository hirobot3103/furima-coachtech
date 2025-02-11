<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Profile;
use App\Models\Order_list;

use App\Http\Requests\PurchaseRequest;

class PurchaseController extends Controller
{
    
    public function index(int $itemId)
    {
        $query = Order_list::where('user_id', Auth::user()->id )->where('item_id', $itemId);
        $itemDatas = $query->first();

        if( empty($itemDatas->item) ) {

            $profileData = Profile::where('user_id', Auth::user()->id )->first();
            
            $orderTable = new Order_list();
            $orderTable->user_id     = Auth::user()->id;
            $orderTable->item_id     = $itemId;
            $orderTable->post_number = $profileData->post_number;
            $orderTable->address     = $profileData->address;
            $orderTable->building    = $profileData->building;
            $orderTable->order_state = 0;
            $orderTable->save();

            $itemData = Item::where('id', $itemId)->first();

        } else {
        
            $profileData = $query->first();
            $itemData = [
                'id'          => $itemDatas['item_id'],
                'user_id'     => $itemDatas->item->user_id,
                'item_name'   => $itemDatas->item->item_name,
                'brand_name'  => $itemDatas->item->brand_name,
                'price'       => $itemDatas->item->price,
                'discription' => $itemDatas->item->dispcription,
                'soldout'     => $itemDatas->item->soldout,
                'status'      => $itemDatas->item->status,
                'img_url'     => $itemDatas->item->img_url,
            ];

        }
        
        return view( 'purchase', compact('itemData', 'profileData'));
    }

    public function buy( PurchaseRequest $request , int $itemId)
    {
        $itemParam = ['soldout' => 1];
        Item::where( 'id', $itemId )->update( $itemParam );
        
        $param = [
          'user_id'         => Auth::user()->id,
          'item_id'         => $itemId,
          'purchase_method' => $request->purchase_method,
          'price'           => $request->price,
          'post_number'     => $request->post_number,
          'address'         => $request->address, 
          'building'        => $request->building,
          'order_state'     => 1,
        ];

        $query = Order_list::where('user_id',Auth::user()->id)->where( 'item_id', $itemId );
        $query->update($param);

        // 決済ページへ
        // $url = "https://www.strip.com";
        // return redirect()->away($url);
        return redirect('/mypage?tag=buy');
    }
}
