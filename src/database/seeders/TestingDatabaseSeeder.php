<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TestingDatabaseSeeder extends Seeder
{
 
    //TESTデータ用seederファイルの指定
    public function run(): void
    {
        $this->call([
            Status_listsTableSeeder::class,
            Category_listsTableSeeder::class,
        ]);
    }
}
