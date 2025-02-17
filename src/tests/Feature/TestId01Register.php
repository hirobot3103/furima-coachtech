<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TestId01Register extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function 会員登録機能_メールアドレスが入力されていない場合バリデーションメッセージが表示される()
    {
        // 会員登録画面を開く
        $response = $this->get('/register');
        $response->assertStatus(200);
        
        // 名前のみ未入力で登録ボタンを押す(送信)
        $response = $this->post('/register', [
            'name' => 'testuser1',
            'email' => '',
            'password' => 'passwordtest',
            'password_confirmation' => 'passwordtest',
        ]);

        // バリデーションエラー発生とメッセージ内容確認
        $response->assertSessionHasErrors(['email' => 'メールアドレスを入力してください']);

    }

    /** @test */
    public function 会員登録機能_パスワードが入力されていない場合バリデーションメッセージが表示される()
    {
        // 会員登録画面を開く
        $response = $this->get('/register');
        $response->assertStatus(200);
        
        // パスワード未入力で登録ボタンを押す
        $response = $this->post('/register', [
            'name' => 'testuser2',
            'email' => 'test2@test.com',
            'password' => '',
            'password_confirmation' => 'passwordtest',
        ]);

        // バリデーションエラー発生とメッセージ内容確認
        $response->assertSessionHasErrors(['password' => 'パスワードを入力してください']);
    }

    /** @test */
    public function 会員登録機能_パスワードが7文字以下の場合バリデーションメッセージが表示される()
    {
        // 会員登録画面を開く
        $response = $this->get('/register');
        $response->assertStatus(200);
        
        // パスワード未入力で登録ボタンを押す
        $response = $this->post('/register', [
            'name' => 'testuser3',
            'email' => 'test3@test.com',
            'password' => '1234567',
            'password_confirmation' => '1234567',
        ]);

        // バリデーションエラー発生とメッセージ内容確認
        $response->assertSessionHasErrors(['password' => 'パスワードは8文字以上で入力してください']);
    }

    /** @test */
    public function 会員登録機能_パスワードが確認用パスワードと一致しない場合バリデーションメッセージが表示される()
    {
        // 会員登録画面を開く
        $response = $this->get('/register');
        $response->assertStatus(200);
        
        // パスワード未入力で登録ボタンを押す
        $response = $this->post('/register', [
            'name' => 'testuser4',
            'email' => 'test4@test.com',
            'password' => '12345678',
            'password_confirmation' => '12345679',
        ]);

        // バリデーションエラー発生とメッセージ内容確認
        $response->assertSessionHasErrors(['password' => 'パスワードと一致しません']);
    }
    
    /** @test */
    public function 会員登録機能_全ての項目が入力されている場合会員情報が登録されログイン画面に遷移される()
    {
    
        // 1. 会員登録ページを開く
        $response = $this->get('/register');
        $response->assertStatus(200);

        // 2. 必要項目を正しく入力して送信
        $response = $this->post('/register', [
            'name' => 'testuser5',
            'email' => 'test5@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'email_verified_at' => ''
        ]);

        // 3. 会員情報がデータベースに登録されていることを確認
        $this->assertDatabaseHas('users', ['email' => 'test5@example.com',]);

        // 4. ログイン画面にリダイレクトされることを確認
        $response->assertRedirect('/');

        // 5. 登録後、プロフィール未登録の場合
        $response = $this->get('/');
        $response->assertRedirect('/mypage/profile');
    }
}
