<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\Order_list;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\AddressRequest;
use App\Http\Requests\Order_listRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

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
            $fileName = 'prof' . Auth::user()->id . '.' . $fileExtension;
            $request->file( 'img_url' )->storeAs( '/public', $fileName );

        } 
        else {
            $fileName = 'prof.jpeg';
        }

        $input = [ 
            'name'        => $request->name,
            'post_number' => $request->post_number,
            'address'     => $request->address,
        ];
        $this->validateAddress($input);

        $query = Profile::where( 'user_id', Auth::user()->id );
        $profileData = $query->first();

        if ( !empty( $profileData ))
        {
            $param = [
                'user_id'     => Auth::user()->id,
                'name'        => $request->name,
                'post_number' => $request->post_number,
                'address'     => $request->address,
                'building'    => $request->building,
                'img_url'     => '/storage/' . $fileName,
                'prof_reg'    => 1,
            ];

            $query->update( $param );                
        }
        else
        {
            $profileDatas = new Profile();
            $profileDatas->name        = $request->name;
            $profileDatas->user_id     = $request->user_id;
            $profileDatas->post_number = $request->post_number;
            $profileDatas->address     = $request->address;
            $profileDatas->building    = $request->building;
            $profileDatas->img_url     = '/storage/' . $fileName;
            $profileDatas->save();            
        }

        return redirect('/');
    }

    public function update( Request $request )
    {
        $query = Profile::where( 'user_id', Auth::user()->id );
        
        if ( !empty($request->img_url) ){

            $input = [ 'img_url' => $request->file('img_url')->getClientOriginalName(),];
            $this->validateUploadFile($input);
    
            $fileExtension = $request->file('img_url')->getClientOriginalExtension();
            $fileName = 'prof' . Auth::user()->id . '.' . $fileExtension;
            $request->file( 'img_url' )->storeAs( '/public', $fileName );

        } else {
            $imgPath = $query->first();
            $fileName =  pathinfo($imgPath['img_url'], PATHINFO_BASENAME);        
        }

        $param = [
            'user_id'     => Auth::user()->id,
            'name'        => $request->name,
            'post_number' => $request->post_number,
            'address'     => $request->address,
            'building'    => $request->building,
            'img_url'     => '/storage/' . $fileName,
            'prof_reg'    => 1,
        ];
        $this->validateAddress($param);

        $query->update( $param );

        return redirect('/');
    }

    public function indexAddress(int $itemId)
    {

        $profileDatas = Profile::where( 'user_id', Auth::user()->id )->first();       

        $query = Order_list::where('user_id', Auth::user()->id )->where('item_id', $itemId);
        $orderData = $query->first();


        if( empty($orderData) ){
            $profId       = $profileDatas->id;
            $profUserId   = $profileDatas->user_id;
            $profName     = $profileDatas->name;
            $profPostCode = $profileDatas->post_number;
            $profAddress  = $profileDatas->address;
            $profBuilding = $profileDatas->building;
            
        } else {        
            $profId       = $orderData->id;
            $profUserId   = $orderData->user_id;
            $profName     = $profileDatas->name;
            $profPostCode = $orderData->post_number;
            $profAddress  = $orderData->address;
            $profBuilding = $orderData->building;
        }

        $profileData = [
            'id'          => $profId,
            'user_id'     => $profUserId,
            'name'        => $profName,
            'post_number' => $profPostCode,
            'address'     => $profAddress,
            'building'    => $profBuilding,
            'prof_reg'    => 1,
        ];

        return view('address', compact('itemId', 'profileData'));
    }

    public function updateAddress(Request $request, int $itemId)
    {
        $param = [
            'user_id'     => Auth::user()->id,
            'post_number' => $request->post_number,
            'address'     => $request->address,
            'building'    => $request->building,
        ];
        $this->validateOrderAddress($param);

        $query = Order_list::where('user_id', Auth::user()->id )->where('item_id', $itemId);
        $query->update( $param );

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

    private function validateOrderAddress(array $input)
    {
        $addressRequestInstance = new Order_listRequest();
        Validator::make($input, $addressRequestInstance->rules(), $addressRequestInstance->messages(),)->validate();
    }
}
