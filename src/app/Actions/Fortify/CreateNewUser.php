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
        $registerRequestInstance = New RegisterRequest();
        
        Validator::make($input,
                        $registerRequestInstance->rules(), 
                        $registerRequestInstance->messages(),
                        )->validate();

        return User::create([
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
