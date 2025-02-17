<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;


use App\Http\Requests\RegisterRequest;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input): User
    {
        $param = [
            'name'  => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
            'password_confirmation' => $input['password_confirmation'],
        ];

        $registerRequestInstance = New RegisterRequest();
        Validator::make($param,
                        $registerRequestInstance->rules(), 
                        $registerRequestInstance->messages(),
                        )->validate();

        $userData = User::create([
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        // 「お名前」部分をProfilesに登録する。(id,name,prof_reg以外はダミーで作成)
        $param = [
            'user_id'     => $userData->id,
            'name'        => $input['name'],
            'post_number' => '000-0000',
            'address'     => 'dammy',
            'building'    => 'dammy',
            'img_url'     => '/storage/prof.jpeg',
            'prof_reg'    => 0,
        ];

        DB::table( 'profiles' )->insert( $param );

        return $userData;
    }
}
