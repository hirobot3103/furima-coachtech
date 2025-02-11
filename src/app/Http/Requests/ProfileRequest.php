<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'img_url' => ['regex:/(.jpeg|.jpg|.png)\z/'],
        ];
    }

    public function messages(): array
    {
        return [
            'img_url.regex' => 'プロフィール画像の拡張子はjpegまたはpngです。',
        ];
    }

    public function attributes()
    {
        return [
            'img_url' => 'プロフィール画像',
        ];
    }

}
