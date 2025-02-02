<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
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
        $param =[
            'user_id' => 1,
            'img_url' => Storage::url('prof.jpeg'),
        ];

        DB::table('profiles')->where('id',1)->update($param);    
    }

    private function setProfileSeedUser2()
    {
        $param =[
            'user_id' => 2,
            'img_url' => Storage::url('prof.jpeg'),
        ];

        DB::table('profiles')->where('id',2)->update($param);    
    }
    private function setProfileSeedUser3()
    {
        $param =[
            'user_id' => 3,
            'img_url' => Storage::url('prof.jpeg'),
        ];

        DB::table('profiles')->where('id',3)->update($param);    
    }
    private function setProfileSeedUser4()
    {
        $param =[
            'user_id' => 4,
            'img_url' => Storage::url('prof.jpeg'),
        ];

        DB::table('profiles')->where('id',4)->update($param);    
    }
    private function setProfileSeedUser5()
    {
        $param =[
            'user_id' => 5,
            'img_url' => Storage::url('prof.jpeg'),
        ];

        DB::table('profiles')->where('id',5)->update($param);    
    }
}
