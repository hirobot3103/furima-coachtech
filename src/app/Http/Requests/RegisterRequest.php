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
<<<<<<< HEAD
            return [
                'email' => 'required | email | max:255 | unique:users',
                'password' => 'required | string | min:8 | confirmed',
            ];
=======
        return [
            'email'                 => 'required | email | max:255 | unique:users',
            'password'              => 'required | string | min:8 | confirmed',
            'password_confirmation' => 'required | string | min:8',

        ];
>>>>>>> db7eefb0901e2a6b8f1295c49da99ea8e42c7aa3
    }

    public function messages(): array
    {
<<<<<<< HEAD
        $commonErrorMessage = 'ログイン情報が登録されていません。aa';

        return [
            'email.required'    => 'メールアドレスを入力してください11',
            'email.email'       => $commonErrorMessage,
            'password.required' => 'パスワードを入力してください11',
            'password.min'      => $commonErrorMessage,
=======
        return [
            'email.required'                 => 'メールアドレスを入力してください',
            'email.email'                    => 'メール形式で入力してください',
            'password.required'              => 'パスワードを入力してください',
            'password.min'                   => 'パスワードは8文字以上で入力してください',
            'password.confirmed'             => 'パスワードと一致しません',
            'password_confirmation.required' => '確認用パスワードを入力してください',
            'password_confirmation.min'      => '確認用パスワードは8文字以上で入力してください',
>>>>>>> db7eefb0901e2a6b8f1295c49da99ea8e42c7aa3
        ];
    }
}
