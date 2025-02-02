<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Profile;

class PurchaseController extends Controller
{
    public function index(int $itemId)
    {
        $itemData = Item::where('id', $itemId)->first();
        $profileData = Profile::where('user_id', Auth::user()->id )->first();

        return view( 'purchase', compact('itemData', 'profileData'));
    }

}
