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
            'email'                 => 'required | email | max:255 | unique:users',
            'password'              => 'required | string | min:8 | confirmed',
            'password_confirmation' => 'required | string | min:8',

        ];
    }

    public function messages(): array
    {
        return [
            'email.required'                 => 'メールアドレスを入力してください',
            'email.email'                    => 'メール形式で入力してください',
            'password.required'              => 'パスワードを入力してください',
            'password.min'                   => 'パスワードは8文字以上で入力してください',
            'password.confirmed'             => 'パスワードと一致しません',
            'password_confirmation.required' => '確認用パスワードを入力してください',
            'password_confirmation.min'      => '確認用パスワードは8文字以上で入力してください',
        ];
    }

    public function attributes()
    {
        return [
            'email'                 => 'メールアドレス',
            'password'              => 'パスワード',
            'password_confirmation' => '確認用パスワード',
        ];
    }
}
