<?php

namespace Tests\Feature;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;


class TestIdFifteenExhibition extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function 出品商品情報登録_商品出品画面にて必要な情報が保存できること()
    {
        
        // ログインユーザーしか出品画面に入れない
        $response = $this->get('/sell');
        $response->assertRedirect('/login');

        // ユーザー作成とログイン
        $user = User::factory()->create();
        $this->actingAs($user);

        // 出品画面表示
        $response = $this->get('/sell');
        $response->assertStatus(200);
        $response->assertSee('商品の出品');

         Storage::fake('storage');

         // ユーザー作成とログイン
         $user = User::factory()->create();
         $this->actingAs($user);
 
        // 商品情報入力

        // 商品画像
        $path = UploadedFile::fake()->image('items99.jpg')->store('storage');

        // 商品情報
        // カテゴリー　cat1: ファッション、cat2:家電を選択
        $data= [
            'item_name' => 'テスト商品',
            'brand_name' => 'テストブランド',
            'price' => 12345,
            'discription' => 'テスト商品の説明です。',
            'souldout' => 0,
            'status' => 1,
            'img_url' => UploadedFile::fake()->image('items99.jpg'),
            'cat1'    => 1,
            'cat2'    => 2,
        ];

        // 登録ボタンを押す（送信）
         $response = $this->post('/sell', $data);
 
         // 画像が保存されていることを確認
         $this->assertTrue(Storage::disk()->exists($path));
 
         // データベースに保存されていることを確認
         $this->assertDatabaseHas('items', [
             'item_name' => 'テスト商品',
             'brand_name' => 'テストブランド',
             'price' => 12345,
             'discription' => 'テスト商品の説明です。',
             'soldout' => 0,
             'status' => 1,
         ]);
 
         // 保存後、リダイレクト先を確認
         $response->assertRedirect('/mypage?tag=sell');       

    }
}
