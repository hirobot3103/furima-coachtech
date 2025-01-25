<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;


class Status_listsTableSeeder extends Seeder
{
    public function run(): void
    {
        $params = [
            [ 'status' => '良好' ],
            [ 'status' => '目立った傷や汚れなし' ],
            [ 'status' => 'やや傷や汚れあり' ],
            [ 'status' => '状態が悪い'],
        ];

        DB::table('status_lists')->insert($params);
    }
}
