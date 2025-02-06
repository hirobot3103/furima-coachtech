<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
                    // 'img_url'     => [ 'required', 'regex:/(.jpg|.png)/' ],
        return [
            'item_name'   => 'required',
            'discription' => 'required | max:255',
            'img_url'     => [ 'required', 'mimetypes:image/jpeg,image/png,' ],
            'cat1'        => 'required_without_all:cat2,cat3,cat4,cat5,cat6,cat7,cat8,cat9,cat10,cat11,cat12,cat13,cat14',
            'status'      => 'required',
            'price'       => 'required | integer | min:0',
        ];
    }

    public function messages()
    {
        return [
            'item_name.required'        => "商品名を入力してください",
            'discription.required'      => "商品説明を入力してください",
            'discription.max'           => "商品説明は255文字以内で入力してください",
            'img_url.required'          => "商品画像を必ず選択してください",
            'img_url.numetypes'         => "商品画像の拡張子はjpegまたはpngです",
            'cat1.required_without_all' => "商品カテゴリーを最低1つ選択してください",
            'status.required'           => "商品状態を選択してください",
            'price.required'            => "商品価格を入力してください",
            'price.integer'             => "商品価格は整数値で指定してください",
            'price.min'                 => "商品価格は0円以上でせっていしてください",
        ];
    }
}
