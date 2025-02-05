<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Order_ListTableSeeder extends Seeder
{
    public function run(): void
    {
        $param = [
            [
                'user_id' => 1,
                'item_id' => 3,
                'purchase_method' => 1,
                'price'           => "300",
                'post_number'     => "000-0000",
                'address'         => "東京都牛込局区内",
                'building'        => "佐川ビル4階",
            ],
            [
                'user_id' => 2,
                'item_id' => 7,
                'purchase_method' => 2,
                'price'           => "3500",
                'post_number'     => "111-1111",
                'address'         => "東京都練馬区豊玉南",
                'building'        => "レジデンス大川201",
            ],
            [
                'user_id' => 2,
                'item_id' => 10,
                'purchase_method' => 2,
                'price'           => "2500",
                'post_number'     => "222-0000",
                'address'         => "東京都練馬区豊玉南",
                'building'        => "レジデンス大川201",
            ],
        ];

        DB::table('order_lists')->insert($param);
    }
}
