<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Profile;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\AddressRequest;

class ProfileController extends Controller
{
    public function index()
    {
        $profileData = Profile::where( 'user_id', Auth::user()->id )->first();
        return view( 'auth.edit-prof', compact('profileData') );
    }

    public function store( Request $request )
    {
        if( !empty($request->img_url) ) {

            $input = [ 'img_url' => $request->file('img_url')->getClientOriginalName(),];
            $this->validateUploadFile($input);
    
            $fileExtension = $request->file('img_url')->getClientOriginalExtension();
            $fileName = 'prof' . Auth::user()->id . $fileExtension;
            $request->file( 'img_url' )->storeAs( '/public', $fileName );

        } 
        else {
            $filename = 'prof.jpeg';
        }

        $input = [ 
            'name'        => $request->name,
            'post_number' => $request->post_number,
            'address'     => $request->address,
        ];
        $this->validateAddress($input);

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

    public function update( Request $request )
    {
        $query = Profile::where( 'user_id', Auth::user()->id );
        
        if ( !empty($request->img_url) ){

            $input = [ 'img_url' => $request->file('img_url')->getClientOriginalName(),];
            $this->validateUploadFile($input);

            $filePath = $request->file( 'img_url' )->store( '/public' );
            $filename = pathinfo($filePath, PATHINFO_BASENAME);            
        } else {
            $imgPath = $query->first();
            $filename =  pathinfo($imgPath['img_url'], PATHINFO_BASENAME);        
        }

        $param = [
            'user_id'     => Auth::user()->id,
            'name'        => $request->name,
            'post_number' => $request->post_number,
            'address'     => $request->address,
            'building'    => $request->building,
            'img_url'     => '/storage/' . $filename,
        ];
        $this->validateAddress($param);

        $query->update( $param );

        return redirect('/');
    }

    public function indexAddress(int $itemId)
    {
        $profileData = Profile::where( 'user_id', Auth::user()->id )->first();

        return view('address', compact('itemId', 'profileData'));
    }

    public function updateAddress(Request $request, int $itemId)
    {
        $param = [
            'user_id'     => Auth::user()->id,
            'name'        => $request->name,
            'post_number' => $request->post_number,
            'address'     => $request->address,
            'building'    => $request->building,
        ];
        $this->validateAddress($param);

        Profile::where( 'user_id', Auth::user()->id )->update( $param );

        return redirect('/purchase/' . $itemId);
    }

    private function validateUploadFile(array $input)
    {
        $profileRequestInstance = new ProfileRequest();
        Validator::make($input, $profileRequestInstance->rules(), $profileRequestInstance->messages(),)->validate();
    }

    private function validateAddress(array $input)
    {
        $addressRequestInstance = new AddressRequest();
        Validator::make($input, $addressRequestInstance->rules(), $addressRequestInstance->messages(),)->validate();
    }
}
