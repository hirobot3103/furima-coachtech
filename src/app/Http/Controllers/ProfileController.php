<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;

class ProfileController extends Controller
{
    public function index()
    {
        return view('auth.edit-prof');
    }

    public function store(Request $request)
    {
        $file_path = $request->file('img_url')->store('/public');

        $profile_datas = new Profile();

        $profile_datas->user_id = $request->user_id;
        // $profile_datas->name = $request->name;
        $profile_datas->post_number = $request->post_number;
        $profile_datas->address = $request->address;
        $profile_datas->builing = $request->building;
        $profile_datas->img_url = $file_path;
        $profile_datas->save();

        return redirect('/');
    }
}
