<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Profile;

class ProfileTableSeeder extends Seeder
{

    public function run(): void
    {
        // Profileテーブルのベースを作成
        Profile::factory()->count(5)->create();

        // Userデータと整合させる
        $this->setProfileSeedUser1();
        $this->setProfileSeedUser2();
        $this->setProfileSeedUser3();
        $this->setProfileSeedUser4();
        $this->setProfileSeedUser5();

    }

    private function setProfileSeedUser1()
    {
        if ( !File::exists( Storage::url( 'prof1.jpg' ) )) 
        {
            copy('public/assets/img/prof1.jpg' ,'storage/app/public/prof1.jpg' );
        }

        $param =[
            'user_id' => 1,
            'img_url' => Storage::url('prof1.jpg'),
        ];

        DB::table('profiles')->where('id',1)->update($param);    
    }

    private function setProfileSeedUser2()
    {
        if ( !File::exists( Storage::url( 'prof2.jpg' ) )) 
        {
            copy('public/assets/img/prof2.jpg' ,'storage/app/public/prof2.jpg' );
        }

        $param =[
            'user_id' => 2,
            'img_url' => Storage::url('prof2.jpg'),
        ];

        DB::table('profiles')->where('id',2)->update($param);    
    }

    private function setProfileSeedUser3()
    {
        if ( !File::exists( Storage::url( 'prof3.jpg' ) )) 
        {
            copy('public/assets/img/prof3.jpg' ,'storage/app/public/prof3.jpg' );
        }

        $param =[
            'user_id' => 3,
            'img_url' => Storage::url('prof3.jpg'),
        ];

        DB::table('profiles')->where('id',3)->update($param);    
    }

    private function setProfileSeedUser4()
    {
        if ( !File::exists( Storage::url( 'prof4.jpg' ) )) 
        {
            copy('public/assets/img/prof4.jpg' ,'storage/app/public/prof4.jpg' );
        }

        $param =[
            'user_id' => 4,
            'img_url' => Storage::url('prof4.jpg'),
        ];

        DB::table('profiles')->where('id',4)->update($param);    
    }

    private function setProfileSeedUser5()
    {

        if ( !File::exists( Storage::url( 'prof5.jpg' ) )) 
        {
            copy('public/assets/img/prof5.jpg' ,'storage/app/public/prof5.jpg' );
        }

        $param =[
            'user_id' => 5,
            'img_url' => Storage::url('prof5.jpg'),
        ];

        DB::table('profiles')->where('id',5)->update($param);    
    }
}
