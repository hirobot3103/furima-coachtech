<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{

    public function run(): void
    {
        
        // Usersテーブル 5人分メール認証済み
        $params = [
            [
                'email'             => 'user1@frima.com',
                'password'          => Hash::make('password1'),
                'email_verified_at' => '2025-02-12 06:38:18',
            ],
            [
                'email'             => 'user2@frima.com',
                'password'          => Hash::make('password2'),
                'email_verified_at' => '2025-02-12 06:38:20',
            ],
            [
                'email'             => 'user3@frima.com',
                'password'          => Hash::make('password3'),
                'email_verified_at' => '2025-02-12 06:38:22',
            ],
            [
                'email'             => 'user4@frima.com',
                'password'          => Hash::make('password4'),
                'email_verified_at' => '2025-02-12 06:38:24',
            ],
            [
                'email'             => 'user5@frima.com',
                'password'          => Hash::make('password5'),
                'email_verified_at' => '2025-02-12 06:38:26',
            ],                                     
        ];

        DB::table( 'users' )->insert( $params );
    }
}