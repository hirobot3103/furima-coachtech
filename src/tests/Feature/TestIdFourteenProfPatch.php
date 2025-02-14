<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;
use App\Models\Profile;

class TestIdFourteenProfPatch extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function ユーザー情報変更_変更項目が初期値として過去設定されていること()
    {
        // ログインユーザーしか画面に入れない
        $response = $this->get('mypage/profile');
        $response->assertRedirect('/login');

        // ユーザー作成とログイン
        $user = User::factory()->create();

        Storage::fake('storage');

        $path = UploadedFile::fake()->image('prof999.jpg')->store('storage');
    
        $profile = Profile::factory()->create([
            'user_id' => $user->id,
            'name' => 'testman',
            'post_number' => '000-0000',
            'address' => '山口県山口市',
            'building' => 'アパート',
            'img_url' => UploadedFile::fake()->image('prof999.jpg'),  
        ]);

        $this->actingAs($user);

        // 出品画面表示
        $response = $this->get('mypage/profile');
        $response->assertStatus(200);
        $response->assertSee('プロフィール設定');

         // 画像が保存されていることを確認
         $this->assertTrue(Storage::disk()->exists($path));
 
         // データベースに保存されていることを確認
         $this->assertDatabaseHas('profiles', [
            'user_id' => $user->id,
            'name' => 'testman',
            'post_number' => '000-0000',
            'address' => '山口県山口市',
            'building' => 'アパート',
        ]);
    }
}
