<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    public function run(): void
    {

        $this->setCategorySeeditem1();
        $this->setCategorySeeditem2();
        $this->setCategorySeeditem3();
        $this->setCategorySeeditem4();
        $this->setCategorySeeditem5();
        $this->setCategorySeeditem6();
        $this->setCategorySeeditem7();
        $this->setCategorySeeditem8();
        $this->setCategorySeeditem9();
        $this->setCategorySeeditem10();

    }

    private function setCategorySeeditem1()
    {
        // item_id:1 腕時計
        // category: ファッション、メンズ、アクセサリー
        $param =[
            [
                'item_id'     => 1,
                'category_id' => 1,
            ],
            [
                'item_id'     => 1,
                'category_id' => 5,
            ],
            [
                'item_id'     => 1,
                'category_id' => 12,
            ],  
        ];

        DB::table('categories')->insert($param);    
    }

    private function setCategorySeeditem2()
    {
        // item_id:2 HDD
        // category: 家電
        $param =[
            [
                'item_id'     => 2,
                'category_id' => 2,
            ],
        ];

        DB::table('categories')->insert($param);    
    }

    private function setCategorySeeditem3()
    {
        // item_id:3 玉ねぎ3束
        // category: キッチン、ハンドメイド
        $param =[
            [
                'item_id'     => 3,
                'category_id' => 10,
            ],
            [
                'item_id'     => 3,
                'category_id' => 11,
            ],
        ];

        DB::table('categories')->insert($param);    
    }

    private function setCategorySeeditem4()
    {
        // item_id:4 革靴
        // category: ファッション、メンズ
        $param =[
            [
                'item_id'     => 4,
                'category_id' => 1,
            ],
            [
                'item_id'     => 4,
                'category_id' => 5,
            ],
        ];

        DB::table('categories')->insert($param);    
    }

    private function setCategorySeeditem5()
    {
        // item_id:5 ノートPC
        // category: 家電、ゲーム
        $param =[
            [
                'item_id'     => 5,
                'category_id' => 2,
            ],
            [
                'item_id'     => 5,
                'category_id' => 8,
            ],
        ];

        DB::table('categories')->insert($param);    
    }

    private function setCategorySeeditem6()
    {
        // item_id:6 マイク
        // category: 家電
        $param =[
            [
                'item_id'     => 6,
                'category_id' => 2,
            ],
        ];

        DB::table('categories')->insert($param);    
    }

    private function setCategorySeeditem7()
    {
        // item_id:7 ショルダーバック
        // category: ファッション、レディース、アクセサリー
        $param =[
            [
                'item_id'     => 7,
                'category_id' => 1,
            ],
            [
                'item_id'     => 7,
                'category_id' => 4,
            ],
            [
                'item_id'     => 7,
                'category_id' => 11,
            ],  
        ];

        DB::table('categories')->insert($param);    
    }

    private function setCategorySeeditem8()
    {
        // item_id:8 タンブラー
        // category: インテリア、キッチン
        $param =[
            [
                'item_id'     => 8,
                'category_id' => 3,
            ],
            [
                'item_id'     => 8,
                'category_id' => 10,
            ],
        ];

        DB::table('categories')->insert($param);    
    }

    private function setCategorySeeditem9()
    {
        // item_id:9 コーヒーミル
        // category: 家電、インテリア、キッチン
        $param =[
            [
                'item_id'     => 9,
                'category_id' => 2,
            ],
            [
                'item_id'     => 9,
                'category_id' => 3,
            ],
            [
                'item_id'     => 9,
                'category_id' => 10,
            ],  
        ];

        DB::table('categories')->insert($param);    
    }

    private function setCategorySeeditem10()
    {
        // item_id:10 メイクセット
        // category: ファッション、レディース、コスメ
        $param =[
            [
                'item_id'     => 10,
                'category_id' => 1,
            ],
            [
                'item_id'     => 10,
                'category_id' => 4,
            ],
            [
                'item_id'     => 10,
                'category_id' => 6,
            ],  
        ];

        DB::table('categories')->insert($param);    
    }
}
