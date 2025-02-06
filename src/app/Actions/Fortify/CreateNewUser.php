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
        $param = [
            'email' => $input['email'],
            'password' => $input['password'],
            'password_confirmation' => $input['password_confirmation'],
        ];
        $registerRequestInstance = New RegisterRequest();
        Validator::make($param,
                        $registerRequestInstance->rules(), 
                        $registerRequestInstance->messages(),
                        )->validate();

        return User::create([
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
