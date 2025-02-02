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
            ],
            [
                'user_id' => 2,
                'item_id' => 7,
            ],
            [
                'user_id' => 2,
                'item_id' => 10,
            ],
        ];

        DB::table('order_lists')->insert($param);
    }
}
