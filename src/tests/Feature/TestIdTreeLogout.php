<?php

namespace Tests\Feature;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TestIdTreeLogout extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function ログアウト機能_ログアウトができる()
    {
       // 1. ユーザーを作成しログイン
       // メール認証済み
        $user = User::factory()->create();

        $this->actingAs($user);

        // ログイン状態の確認
        $this->assertAuthenticatedAs($user);

        // 2. ログアウトボタンを押す（送信）
        $response = $this->post('/logout');

        // 3. ログアウトが成功したことを確認
        $response->assertRedirect('/');
        $this->assertGuest();
    }
}
