<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
            return [
                
                'email' => 'required | email | max:255 | unique:users',
                'password' => 'required | string | min:8 | confirmed',
            ];
    }

    public function messages(): array
    {
        $commonErrorMessage = 'ログイン情報が登録されていません。aa';

        return [
            'email.required'    => 'メールアドレスを入力してください11',
            'email.email'       => $commonErrorMessage,
            'password.required' => 'パスワードを入力してください11',
            'password.min'      => $commonErrorMessage,
        ];
    }
}
