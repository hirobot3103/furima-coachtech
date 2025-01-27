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

        $profileDatas = new Profile();

        $profileDatas->user_id     = $request->user_id;
        $profileDatas->post_number = $request->post_number;
        $profileDatas->address     = $request->address;
        $profileDatas->builing     = $request->building;
        $profileDatas->img_url     = $filePath;

        $profileDatas->save();

        return redirect('/');
    }
}
