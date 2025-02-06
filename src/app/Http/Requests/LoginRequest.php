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
            'email'                 => 'required | email',
            'password'              => 'required | min:8',
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
