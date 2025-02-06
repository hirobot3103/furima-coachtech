<?php

namespace App\Http\Requests;

use Laravel\Fortify\Http\Requests\LoginRequest as FortifyLoginRequest;

class  LoginRequest extends FortifyLoginRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
<<<<<<< HEAD
            'email' => 'required | email',
            'password' => 'required | min:8',
=======
            'email'                 => 'required | email',
            'password'              => 'required | min:8',
>>>>>>> db7eefb0901e2a6b8f1295c49da99ea8e42c7aa3
        ];
    }

    public function messages(): array
    {
        $commonErrorMessage = 'ログイン情報が登録されていません。';

        return [
            'email.required'    => 'メールアドレスを入力してください',
            'email.email'       => $commonErrorMessage,
            'password.required' => 'パスワードを入力してください',
            'password.min'      => $commonErrorMessage,
        ];
    }
}
