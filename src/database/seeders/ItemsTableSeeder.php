<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class ItemsTableSeeder extends Seeder
{

    public function run(): void
    {
        
        $this->setItemSeedUser1(1);

        $params = [
            [
                'user_id' => 1,
                'item_name' => '革靴',
                'brand_name' => 'ヤドラス',
                'price' => 4000,
                'discription' => 'クラシックなデザインの革靴',
                'soldout' => 0,
                'status' => 4,
                'img_url' => Storage::url('Leather+Shoes+Product+Photo.jpg'),
            ],
            [
                'user_id' => 1,
                'item_name' => 'ノートPC',
                'brand_name' => 'CAT COMPUTER',
                'price' => 45000,
                'discription' => '高性能なノートパソコン',
                'soldout' => 0,
                'status' => 1,
                'img_url' => Storage::url('Living+Room+Laptop.jpg'),
            ],
            [
                'user_id' => 1,
                'item_name' => 'マイク',
                'brand_name' => 'CANWOOD',
                'price' => 8000,
                'discription' => '高音質のレコーディング用マイク',
                'soldout' => 0,
                'status' => 2,
                'img_url' => Storage::url('Music+Mic+4632231.jpg'),
            ],
            [
                'user_id' => 1,
                'item_name' => 'ショルダーバッグ',
                'brand_name' => '大熊カバン店',
                'price' => 3500,
                'discription' => 'おしゃれなショルダーバッグ',
                'soldout' => 0,
                'status' => 3,
                'img_url' => Storage::url('Purse+fashion+pocket.jpg'),
            ],
            [
                'user_id' => 1,
                'item_name' => 'タンブラー',
                'brand_name' => 'サイコー',
                'price' => 500,
                'discription' => '使いやすいタンブラー',
                'soldout' => 0,
                'status' => 4,
                'img_url' => Storage::url('Tumbler+souvenir.jpg'),
            ],
            [
                'user_id' => 1,
                'item_name' => 'コーヒーミル',
                'price' => 4000,
                'discription' => '手動のコーヒーミル',
                'soldout' => 0,
                'status' => 1,
                'img_url' => Storage::url('Waitress+with+Coffee+Grinder.jpg'),
            ],
            [
                'user_id' => 1,
                'item_name' => 'メイクセット',
                'price' => 2500,
                'discription' => '便利なメイクアップセット',
                'soldout' => 0,
                'status' => 2,
                'img_url' => Storage::url('外出メイクアップセット.jpg'),
            ],
        ];
    }

    function setItemSeedUser1( int $userId )
    {
        $params = [
            [
                'user_id'     => $userId,
                'item_name'   => '腕時計',
                'brand_name'  => 'サイコー',
                'price'       => 15000,
                'discription' => 'スタイリッシュなデザインのメンズ腕時計',
                'soldout'     => 0,
                'status'      => 1,
                'img_url'     => Storage::url( 'Armani+Mens+Clock.jpg' ),
            ],
            [
                'user_id'     => $userId,
                'item_name'   => 'HDD',
                'brand_name'  => 'SKANDISK',
                'price'       => 5000,
                'discription' => '高速で信頼性の高いハードディスク',
                'soldout'     => 0,
                'status'      => 2,
                'img_url'     => Storage::url( 'HDD+Hard+Disk.jpg' ),
            ],
            [
                'user_id' => $userId,
                'item_name' => '玉ねぎ3束',
                'brand_name' => '○○産',
                'price' => 300,
                'discription' => '新鮮な玉ねぎ3束のセット',
                'soldout' => 0,
                'status' => 3,
                'img_url' => Storage::url('iLoveIMG+d.jpg'),
            ],
        ];
    
        DB::table( 'items' )->insert( $params );
    }

    function setProfileSeedUser2( int $userId )
    {
        $params = [
            [
                'user_id'     => $userId,
                'item_name'   => '腕時計',
                'brand_name'  => 'サイコー',
                'price'       => 15000,
                'discription' => 'スタイリッシュなデザインのメンズ腕時計',
                'soldout'     => 0,
                'status'      => 1,
                'img_url'     => Storage::url( 'Armani+Mens+Clock.jpg' ),
            ],
            [
                'user_id'     => $userId,
                'item_name'   => 'HDD',
                'brand_name'  => 'SKANDISK',
                'price'       => 5000,
                'discription' => '高速で信頼性の高いハードディスク',
                'soldout'     => 0,
                'status'      => 2,
                'img_url'     => Storage::url( 'HDD+Hard+Disk.jpg' ),
            ],
            [
                'user_id' => $userId,
                'item_name' => '玉ねぎ3束',
                'brand_name' => '○○産',
                'price' => 300,
                'discription' => '新鮮な玉ねぎ3束のセット',
                'soldout' => 0,
                'status' => 3,
                'img_url' => Storage::url('iLoveIMG+d.jpg'),
            ],
        ];
    
        DB::table( 'items' )->insert( $params );
    }

}
