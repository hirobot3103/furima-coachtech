<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category_list;
use App\Models\Status_list;
use App\Models\Item;
use App\Models\Category;
use App\http\Requests\ExhibitionRequest;

class SellController extends Controller
{
    public function index()
    {
        $categoryLists = Category_list::all();
        $statusLists = Status_list::all();

        return view('sell', compact('categoryLists', 'statusLists'));
    }

    public function store(ExhibitionRequest $request)
    {
        if( !empty($request->img_url) ) {
            $filePath = $request->file( 'img_url' )->store( '/public' );
            $filename = pathinfo($filePath, PATHINFO_BASENAME);
        } else {
            $filename = 'prof.jpeg';
        }
        
        $itemDatas = new item();
        $param = [
            'user_id'     => Auth::user()->id,
            'item_name'   => $request->item_name,
            'brand_name'  => $request->brand_name,
            'price'       => $request->price,
            'discription' => $request->discription,
            'soldout'     => 0,
            'status'      => $request->status,
            'img_url'     => '/storage/' . $filename,    
        ];
        $newRecord = $itemDatas->create($param);

        // 選択したカテゴリー関係
        $categoryListsCount = Category_list::all()->count();
        for( $count = 1; $count <= $categoryListsCount; $count++){
            $inputName = "cat" . $count;
            if (!empty($request[$inputName])) {
                $paramCat[] = [
                    'item_id'     => $newRecord['id'],
                    'category_id' => $request[$inputName],
                ];
            }
        }
        Category::insert($paramCat);

        return redirect('/mypage?tag=sell');
    }
}
