<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User; // App\Models\User を正しくインポートする

class ExampleTest extends TestCase
{
    // データベースを初期化する
    use RefreshDatabase;

    /**
     * アプリケーションが正常なレスポンスを返すことをテストする
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        // テストユーザーを作成してログインする
        $user = User::factory()->create();
        $this->actingAs($user);

        // テストを実行
        $response = $this->get('/');

        // 正常なレスポンスが返ってくることをアサートする
        $response->assertStatus(200);
    }
}