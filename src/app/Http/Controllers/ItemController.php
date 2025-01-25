<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class ItemController extends Controller
{
    public function index()
    {
        $item_data = Item::All();

        return view('index', compact('item_data'));
    } 
}
