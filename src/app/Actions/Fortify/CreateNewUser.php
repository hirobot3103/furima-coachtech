<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

use App\Http\Requests\RegisterRequest;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public function create(array $input): User
    {
<<<<<<< HEAD
        $registerRequestInstance = New RegisterRequest();
        
        Validator::make($input,
=======
        $param = [
            'email' => $input['email'],
            'password' => $input['password'],
            'password_confirmation' => $input['password_confirmation'],
        ];
        $registerRequestInstance = New RegisterRequest();
        Validator::make($param,
>>>>>>> db7eefb0901e2a6b8f1295c49da99ea8e42c7aa3
                        $registerRequestInstance->rules(), 
                        $registerRequestInstance->messages(),
                        )->validate();

        return User::create([
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
