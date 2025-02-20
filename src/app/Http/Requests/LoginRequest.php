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
            'email'    => 'required | email | exists:App\Models\User,email',
            'password' => 'required | min:8',
=======
<<<<<<< HEAD
            'email' => 'required | email',
            'password' => 'required | min:8',
=======
            'email'                 => 'required | email',
            'password'              => 'required | min:8',
>>>>>>> db7eefb0901e2a6b8f1295c49da99ea8e42c7aa3
>>>>>>> dfae482d2a9bff2985c4ae3696cc1e7bc9127f41
        ];
    }

    public function messages(): array
    {
        $commonErrorMessage = 'ログイン情報が登録されていません';

        return [
            'email.required'    => 'メールアドレスを入力してください',
            'email.email'       => 'メール形式で入力してください',
            'email.exists'      => $commonErrorMessage,
            'password.required' => 'パスワードを入力してください',
            'password.min'      => 'パスワードは8文字以上で入力してください',
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'メールアドレス',
            'password' => 'パスワード',
        ];
    }

}
