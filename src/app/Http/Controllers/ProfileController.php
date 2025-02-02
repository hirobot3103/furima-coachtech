<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        return view( 'auth.edit-prof' );
    }

    public function store( Request $request )
    {
        $filePath = $request->file( 'img_url' )->store( '/public' );
        $filename = pathinfo($filePath, PATHINFO_BASENAME);

        $profileDatas = new Profile();
        $profileDatas->name        = $request->name;
        $profileDatas->user_id     = $request->user_id;
        $profileDatas->post_number = $request->post_number;
        $profileDatas->address     = $request->address;
        $profileDatas->building     = $request->building;
        $profileDatas->img_url     = '/storage/' . $filename;

        $profileDatas->save();

        return redirect('/');
    }
}
