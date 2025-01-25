<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{

    public function run(): void
    {
        // user_id:1 が14商品すべてを出品しているデータを作成
        $params = [
            [
                'user_id' => 1,
                'item_name' => '腕時計',
                'price' => 15000,
                'discription' => 'スタイリッシュなデザインのメンズ腕時計',
                'soldout' => 0,
                'status' => 1,
                'img_url' => '',
            ],
            [
                'user_id' => 1,
                'item_name' => 'HDD',
                'price' => 5000,
                'discription' => '高速で信頼性の高いハードディスク',
                'soldout' => 0,
                'status' => 2,
                'img_url' => '',
            ],
            [
                'user_id' => 1,
                'item_name' => '玉ねぎ3束',
                'price' => 300,
                'discription' => '新鮮な玉ねぎ3束のセット',
                'soldout' => 0,
                'status' => 3,
                'img_url' => '',
            ],
            [
                'user_id' => 1,
                'item_name' => '革靴',
                'price' => 4000,
                'discription' => 'クラシックなデザインの革靴',
                'soldout' => 0,
                'status' => 4,
                'img_url' => '',
            ],
            [
                'user_id' => 1,
                'item_name' => 'ノートPC',
                'price' => 45000,
                'discription' => '高性能なノートパソコン',
                'soldout' => 0,
                'status' => 1,
                'img_url' => '',
            ],
            [
                'user_id' => 1,
                'item_name' => 'マイク',
                'price' => 8000,
                'discription' => '高音質のレコーディング用マイク',
                'soldout' => 0,
                'status' => 2,
                'img_url' => '',
            ],
            [
                'user_id' => 1,
                'item_name' => 'ショルダーバッグ',
                'price' => 3500,
                'discription' => 'おしゃれなショルダーバッグ',
                'soldout' => 0,
                'status' => 3,
                'img_url' => '',
            ],
            [
                'user_id' => 1,
                'item_name' => 'タンブラー',
                'price' => 500,
                'discription' => '使いやすいタンブラー',
                'soldout' => 0,
                'status' => 4,
                'img_url' => '',
            ],
            [
                'user_id' => 1,
                'item_name' => 'コーヒーミル',
                'price' => 4000,
                'discription' => '手動のコーヒーミル',
                'soldout' => 0,
                'status' => 1,
                'img_url' => '',
            ],
            [
                'user_id' => 1,
                'item_name' => 'メイクセット',
                'price' => 2500,
                'discription' => '便利なメイクアップセット',
                'soldout' => 0,
                'status' => 2,
                'img_url' => '',
            ],
        ];

        DB::table('items')->insert($params);        
    }
}
