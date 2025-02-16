<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run(): void
    {
        $this->call(Status_listsTableSeeder::class);
        $this->call(Category_listsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProfileTableSeeder::class);
        $this->call(ItemsTableSeeder::class);
        $this->call(FavoritsTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(CommentTableSeeder::class);
        $this->call(Order_ListTableSeeder::class);
    }
}
