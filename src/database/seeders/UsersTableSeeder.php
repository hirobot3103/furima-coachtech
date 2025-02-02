<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{

    public function run(): void
    {

        // Usersテーブル 5人分
        $this->setUserSeed1();
        $this->setUserSeed2();
        $this->setUserSeed3();
        $this->setUserSeed4();
        $this->setUserSeed5();
        
    }

    private function setUserSeed1()
    {
    
        $params = [
            'email'    => 'user1@frima.com',
            'password' => Hash::make('password1'),
        ];

        DB::table( 'users' )->insert( $params );
    }

    private function setUserSeed2()
    {
    
        $params = [
            'email'    => 'user2@frima.com',
            'password' => Hash::make('password2'),
        ];

        DB::table( 'users' )->insert( $params );
    }

    private function setUserSeed3()
    {
    
        $params = [
            'email'    => 'user3@frima.com',
            'password' => Hash::make('password3'),
        ];

        DB::table( 'users' )->insert( $params );
    }

    private function setUserSeed4()
    {
    
        $params = [
            'email'    => 'user4@frima.com',
            'password' => Hash::make('password4'),
        ];

        DB::table( 'users' )->insert( $params );
    }

    private function setUserSeed5()
    {
    
        $params = [
            'email'    => 'user5@frima.com',
            'password' => Hash::make('password5'),
        ];

        DB::table( 'users' )->insert( $params );
    }
}
