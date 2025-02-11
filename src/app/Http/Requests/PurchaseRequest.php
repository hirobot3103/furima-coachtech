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
            'purchase_method' => 'required_if:order_state,1|required' ,
            'post_number'     => 'required' ,
            'address'         => 'required' ,
        ];
    }

    public function messages()
    {
        // purchase_method.required_ifへ変更すること
        return [
            'purchase_method.required' => "お支払い方法を選択してください",
            'post_number.required'     => "配送先の郵便番号を設定してください",
            'address.required'         => "配送先の住所を設定してください",
        ];
    }
}
