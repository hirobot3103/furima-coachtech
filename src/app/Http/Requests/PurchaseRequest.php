<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'purchase_method' => 'required' ,
            'post_number'     => 'required' ,
            'address'         => 'required' ,
        ];
    }

    public function messages()
    {
        return [
            'purchase_method.required' => "お支払い方法を選択してください",
            'post_number.required'     => "配送先の郵便番号を設定してください",
            'address.required'         => "配送先の住所を設定してください",
        ];
    }
}
