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
        if ( !File::exists( Storage::url( 'prof.jpeg' ) )) 
        {
            copy('public/assets/img/prof.jpeg' ,'storage/app/public/prof.jpeg' );
        }
        $this->setProfileSeedUser1();
        $this->setProfileSeedUser2();
        $this->setProfileSeedUser3();
        $this->setProfileSeedUser4();
        $this->setProfileSeedUser5();

    }

    private function setProfileSeedUser1()
    {
        if ( !File::exists( Storage::url( 'prof1.jpeg' ) )) 
        {
            copy('public/assets/img/prof1.jpeg' ,'storage/app/public/prof1.jpeg' );
        }

        $param =[
            'user_id' => 1,
            'img_url' => Storage::url('prof1.jpeg'),
        ];

        DB::table('profiles')->where('id',1)->update($param);    
    }

    private function setProfileSeedUser2()
    {
        if ( !File::exists( Storage::url( 'prof2.jpeg' ) )) 
        {
            copy('public/assets/img/prof2.jpeg' ,'storage/app/public/prof2.jpeg' );
        }

        $param =[
            'user_id' => 2,
            'img_url' => Storage::url('prof2.jpeg'),
        ];

        DB::table('profiles')->where('id',2)->update($param);    
    }

    private function setProfileSeedUser3()
    {
        if ( !File::exists( Storage::url( 'prof3.jpeg' ) )) 
        {
            copy('public/assets/img/prof3.jpeg' ,'storage/app/public/prof3.jpeg' );
        }

        $param =[
            'user_id' => 3,
            'img_url' => Storage::url('prof3.jpeg'),
        ];

        DB::table('profiles')->where('id',3)->update($param);    
    }

    private function setProfileSeedUser4()
    {
        if ( !File::exists( Storage::url( 'prof4.jpeg' ) )) 
        {
            copy('public/assets/img/prof4.jpeg' ,'storage/app/public/prof4.jpeg' );
        }

        $param =[
            'user_id' => 4,
            'img_url' => Storage::url('prof4.jpeg'),
        ];

        DB::table('profiles')->where('id',4)->update($param);    
    }

    private function setProfileSeedUser5()
    {

        if ( !File::exists( Storage::url( 'prof5.jpeg' ) )) 
        {
            copy('public/assets/img/prof5.jpeg' ,'storage/app/public/prof5.jpeg' );
        }

        $param =[
            'user_id' => 5,
            'img_url' => Storage::url('prof5.jpeg'),
        ];

        DB::table('profiles')->where('id',5)->update($param);    
    }
}
