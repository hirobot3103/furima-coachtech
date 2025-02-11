<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required',
            'post_number' => [
                              'required', 
                              'size:8',
                              'regex:/\A\d{3}[-]\d{4}\z/'
                             ],
            'address'     => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required'        => "お名前を入力してください",
            'post_number.required' => "郵便番号を入力してください",
            'post_number.size'     => "郵便番号はハイフンを含む8文字で入力してください",
            'post_number.required' => "郵便番号の形式に則って入力してください",
            'address.required'     => '住所を入力してください',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'お名前',
            'post_number' => '郵便番号',
            'address' => '住所',
        ];
    }
}