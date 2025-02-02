<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoritsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // いいね関連データの作成
        // user_id:1  いいね対象：item_id: 3, 4, 5
        $this->setFavoritSeed1();

        // user_id:2  いいね対象：item_id: 5, 6, 7, 8
        $this->setFavoritSeed2();

        // user_id:3  いいね対象：item_id: 7, 8, 9
        $this->setFavoritSeed3();

        // user_id:4  いいね対象：item_id: 1, 2, 3, 9, 10
        $this->setFavoritSeed4();

        // user_id:5  いいね対象：item_id: 1, 2, 3, 4
        $this->setFavoritSeed5();

    }

    private function setFavoritSeed1()
    {
        $params = [
            [
                'user_id' => 1,
                'item_id' => 3,
            ],
            [
                'user_id' => 1,
                'item_id' => 4,
            ],
            [
                'user_id' => 1,
                'item_id' => 5,
            ],     
        ];

        DB::table('favorits')->insert($params);
    }

    private function setFavoritSeed2()
    {
        $params = [
            [
                'user_id' => 2,
                'item_id' => 5,
            ],
            [
                'user_id' => 2,
                'item_id' => 6,
            ],    
            [
                'user_id' => 2,
                'item_id' => 7,
            ],
            [
                'user_id' => 2,
                'item_id' => 8,
            ], 
        ];

        DB::table('favorits')->insert($params);
    }

    private function setFavoritSeed3()
    {
        $params = [
            [
                'user_id' => 3,
                'item_id' => 7,
            ],
            [
                'user_id' => 3,
                'item_id' => 8,
            ],    
            [
                'user_id' => 3,
                'item_id' => 9,
            ],        
        ];

        DB::table('favorits')->insert($params);
    }

    private function setFavoritSeed4()
    {
        $params = [
            [
                'user_id' => 4,
                'item_id' => 1,
            ],    
            [
                'user_id' => 4,
                'item_id' => 2,
            ],    
            [
                'user_id' => 4,
                'item_id' => 3,
            ],                            
            [
                'user_id' => 4,
                'item_id' => 9,
            ],
            [
                'user_id' => 4,
                'item_id' => 10,
            ],    
        ];

        DB::table('favorits')->insert($params);
    }

    private function setFavoritSeed5()
    {
        $params = [
            [
                'user_id' => 5,
                'item_id' => 1,
            ],
            [
                'user_id' => 5,
                'item_id' => 2,
            ],    
            [
                'user_id' => 5,
                'item_id' => 3,
            ],
            [
                'user_id' => 5,
                'item_id' => 4,
            ],    
        ];

        DB::table('favorits')->insert($params);
    }
}
