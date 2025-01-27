<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class Category_listsTableSeeder extends Seeder
{

    public function run(): void
    {
        $params = [
            [ 'category_name' => 'ファッション' ],
            [ 'category_name' => '家電' ],
            [ 'category_name' => 'インテリア' ],
            [ 'category_name' => 'レディース' ],
            [ 'category_name' => 'メンズ' ],
            [ 'category_name' => 'コスメ' ],
            [ 'category_name' => '本' ],
            [ 'category_name' => 'ゲーム' ],
            [ 'category_name' => 'スポーツ' ],
            [ 'category_name' => 'キッチン' ],
            [ 'category_name' => 'ハンドメイド' ],
            [ 'category_name' => 'アクセサリー' ],
            [ 'category_name' => 'おもちゃ' ],
            [ 'category_name' => 'ベビー・キッズ' ],
        ];

        DB::table( 'category_lists' )->insert( $params );        
    }
}
