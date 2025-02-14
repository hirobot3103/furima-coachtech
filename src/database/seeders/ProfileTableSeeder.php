<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Profile;

class ProfileTableSeeder extends Seeder
{

    public function run(): void
    {
        // Profileデータの土台を作成
        Profile::factory()->count(5)->create();
        
        // プロフィール画像のデフォルト画像を用意
        if ( !File::exists( Storage::url( 'prof.jpeg' ) )) 
        {
            copy('public/assets/img/prof.jpeg' ,'storage/app/public/prof.jpeg' );
        }

        // プロフィール画像を用意
        $this->setProfileSeedUserImage( 1 , 'prof1.jpeg' );
        $this->setProfileSeedUserImage( 2 , 'prof2.jpeg' );
        $this->setProfileSeedUserImage( 3 , 'prof3.jpeg' );
        $this->setProfileSeedUserImage( 4 , 'prof4.jpeg' );
        $this->setProfileSeedUserImage( 5 , 'prof5.jpeg' );

    }

    private function setProfileSeedUserImage( $id , $fileName )
    {
        if ( !File::exists( Storage::url( $fileName ) )) 
        {
            copy('public/assets/img/' . $fileName , 'storage/app/public/' . $fileName );
        }

        $param =[
            'img_url' => Storage::url( $fileName ),
        ];

        DB::table('profiles')->where('id', $id)->update($param);    
    }
}
