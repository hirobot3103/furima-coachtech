<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class ItemsTableSeeder extends Seeder
{

    public function run(): void
    {
        
        // Userごとに出品ダミーデータの作成
        $this->setItemSeedUser1(1);
        $this->setItemSeedUser2(2);
        $this->setItemSeedUser3(3);
        $this->setItemSeedUser4(4);
        $this->setItemSeedUser5(5);

    }

    private function setItemSeedUser1( int $userId )
    {

        // 存在しなければ、Strageにダミー商品画像をコピー
        if ( !File::exists( Storage::url( 'Armani+Mens+Clock.jpg' ) )) 
        {
            Storage::copy( asset( 'assets/img/Armani+Mens+Clock.jpg' ) , 'storage/app/public/Armani+Mens+Clock.jpg' ); 
        }

        if ( !File::exists( Storage::url( 'HDD+Hard+Disk.jpg' ) )) 
        {
            Storage::copy( asset( 'assets/img/HDD+Hard+Disk.jpg' ) , 'storage/app/public/HDD+Hard+Disk.jpg' ); 
        }
    
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
        ];
    
        DB::table( 'items' )->insert( $params );
    }

    private function setItemSeedUser2( int $userId )
    {
 
        if ( !File::exists( Storage::url( 'iLoveIMG+d.jpg' ) )) 
        {
            Storage::copy( asset( 'assets/img/iLoveIMG+d.jpg' ) , 'storage/app/public/iLoveIMG+d.jpg' ); 
        }

        if ( !File::exists( Storage::url( 'Leather+Shoes+Product+Photo.jpg' ) )) 
        {
            Storage::copy( asset( 'assets/img/Leather+Shoes+Product+Photo.jpg' ) , 'storage/app/public/Leather+Shoes+Product+Photo.jpg' ); 
        }

        $params = [
            [
                'user_id'     => $userId,
                'item_name'   => '玉ねぎ3束',
                'brand_name'  => '○○産',
                'price'       => 300,
                'discription' => '新鮮な玉ねぎ3束のセット',
                'soldout'     => 1,
                'status'      => 3,
                'img_url'     => Storage::url('iLoveIMG+d.jpg'),
            ],
            [
                'user_id'     => $userId,
                'item_name'   => '革靴',
                'brand_name'  => 'ヤドラス',
                'price'       => 4000,
                'discription' => 'クラシックなデザインの革靴',
                'soldout'     => 0,
                'status'      => 4,
                'img_url'     => Storage::url('Leather+Shoes+Product+Photo.jpg'),
            ],
        ];

        DB::table( 'items' )->insert( $params );
    }

    private function setItemSeedUser3( int $userId )
    {

        if ( !File::exists( Storage::url( 'Living+Room+Laptop.jpg' ) )) 
        {
            Storage::copy( asset( 'assets/img/Living+Room+Laptop.jpg' ) , 'storage/app/public/Living+Room+Laptop.jpg' ); 
        }

        if ( !File::exists( Storage::url( 'Music+Mic+4632231.jpg' ) )) 
        {
            Storage::copy( asset( 'assets/img/Music+Mic+4632231.jpg' ) , 'storage/app/public/Music+Mic+4632231.jpg' ); 
        }

        $params = [
            [
                'user_id'     => $userId,
                'item_name'   => 'ノートPC',
                'brand_name'  => 'CAT COMPUTER',
                'price'       => 45000,
                'discription' => '高性能なノートパソコン',
                'soldout'     => 0,
                'status'      => 1,
                'img_url'     => Storage::url('Living+Room+Laptop.jpg'),
            ],
            [
                'user_id'     => $userId,
                'item_name'   => 'マイク',
                'brand_name'  => 'CANWOOD',
                'price'       => 8000,
                'discription' => '高音質のレコーディング用マイク',
                'soldout'     => 0,
                'status'      => 2,
                'img_url'     => Storage::url('Music+Mic+4632231.jpg'),
            ],
        ];

        DB::table( 'items' )->insert( $params );
    }

    private function setItemSeedUser4( int $userId )
    {

        if ( !File::exists( Storage::url( 'Purse+fashion+pocket.jpg' ) )) 
        {
            Storage::copy( asset( 'assets/img/Purse+fashion+pocket.jpg' ) , 'storage/app/public/Purse+fashion+pocket.jpg' ); 
        }

        if ( !File::exists( Storage::url( 'Tumbler+souvenir.jpg' ) )) 
        {
            Storage::copy( asset( 'assets/img/Tumbler+souvenir.jpg' ) , 'storage/app/public/Tumbler+souvenir.jpg' ); 
        }

        $params = [
            [
                'user_id'     => $userId,
                'item_name'   => 'ショルダーバッグ',
                'brand_name'  => '大熊カバン店',
                'price'       => 3500,
                'discription' => 'おしゃれなショルダーバッグ',
                'soldout'     => 1,
                'status'      => 3,
                'img_url'     => Storage::url('Purse+fashion+pocket.jpg'),
            ],
            [
                'user_id'     => $userId,
                'item_name'   => 'タンブラー',
                'brand_name'  => 'チーター魔法瓶',
                'price'       => 500,
                'discription' => '使いやすいタンブラー',
                'soldout'     => 0,
                'status'      => 4,
                'img_url'     => Storage::url('Tumbler+souvenir.jpg'),
            ],
        ];

        DB::table( 'items' )->insert( $params );
    }

    private function setItemSeedUser5( int $userID )
    {

        if ( !File::exists( Storage::url( 'Waitress+with+Coffee+Grinder.jpg' ) )) 
        {
            Storage::copy( asset( 'assets/img/Waitress+with+Coffee+Grinder.jpg' ) , 'storage/app/public/Waitress+with+Coffee+Grinder.jpg' ); 
        }

        if ( !File::exists( Storage::url( '外出メイクアップセット.jpg' ) )) 
        {
            Storage::copy( asset( 'assets/img/外出メイクアップセット.jpg' ) , 'storage/app/public/外出メイクアップセット.jpg' ); 
        }

        $params = [
            [
                'user_id'     => $userID,
                'item_name'   => 'コーヒーミル',
                'brand_name'  => '下島珈琲',
                'price'       => 4000,
                'discription' => '手動のコーヒーミル',
                'soldout'     => 0,
                'status'      => 1,
                'img_url'     => Storage::url('Waitress+with+Coffee+Grinder.jpg'),
            ],
            [
                'user_id'     => $userID,
                'item_name'   => 'メイクセット',
                'brand_name'  => 'HOLA化粧品',
                'price'       => 2500,
                'discription' => '便利なメイクアップセット',
                'soldout'     => 1,
                'status'      => 2,
                'img_url'     => Storage::url('外出メイクアップセット.jpg'),
            ],
        ];

        DB::table( 'items' )->insert( $params );
    }
}
