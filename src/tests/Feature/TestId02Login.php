<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Profile;
use App\Models\Item;
use App\Models\Order_list;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TestId02Login extends TestCase
{

    use RefreshDatabase;

    protected $exhibitUserData; 
    protected $exhibitProfileData;
    protected $exhibitItemData;

    protected $purchaseUserData;
    protected $purchaseProfileData;
    protected $purchaseItemData;

    protected $orderDatas;

    protected function setUp():void
    {    
        parent::setUp();

        $this->makeExhibitUserData();
        $this->makePurchaseUserData();
    }

    /** @test */
    public function ログイン機能_メールアドレスが入力されていない場合、バリデーションメッセージが表示される()
    {
        // ログイン画面を開く
        $response = $this->get('/login');
        $response->assertStatus(200);
        
        // メールアドレス未入力でボタンを押す(送信)
        $response = $this->post('/login', [
            'email' => '',
            'password' => 'passwordtest',
        ]);

        // バリデーションエラー発生とメッセージ内容確認
        $response->assertSessionHasErrors(['email' => 'メールアドレスを入力してください']);
    
    }

    /** @test */
    public function ログイン機能_パスワードが入力されていない場合バリデーションメッセージが表示される()
    {
        global $purchaseUserData;

        // 会員登録画面を開く
        $response = $this->get('/login');
        $response->assertStatus(200);
        
        // パスワード未入力で登録ボタンを押す
        $response = $this->post('/login', [
            'email' => $purchaseUserData->email,
            'password' => '',
        ]);

        // バリデーションエラー発生とメッセージ内容確認
        $response->assertSessionHasErrors(['password' => 'パスワードを入力してください']);
    }

    /** @test */
    public function ログイン機能_入力情報が間違っている場合バリデーションメッセージが表示される()
    {
        // ログイン画面を開く
        $response = $this->get('/login');
        $response->assertStatus(200);
        
        // 必須項目に間違った情報を入力し登録ボタンを押す
        // (正)email: testman1@test.com  password: password123
        $response = $this->post('/login', [
            'email' => 'test3@test.com',
            'password' => '12345678',
        ]);

        // バリデーションエラー発生とメッセージ内容確認
        $response->assertSessionHasErrors(['email' => 'ログイン情報が登録されていません']);
    }
    
    /** @test */
    public function ログイン機能_正しい情報が入力された場合ログイン処理が実行される()
    {
        global $purchaseUserData;
    
        // 1. ログインページを開く
        $response = $this->get('/login');
        $response->assertStatus(200);

        // 2. 必要項目を正しく入力して送信
        $response = $this->post('/login', [
            'email' => $purchaseUserData->email,
            'password' => 'password123',
        ]);

        $this->actingAs($purchaseUserData);
        $this->assertAuthenticated();

        // 4. 商品一覧が表示されることを確認
        $response->assertRedirect('/');
    }

    private function makeExhibitUserData()
    {
        global $exhibitUserData, $exhibitProfileData, $exhibitItemData;
        
        $exhibitUserData = new User;
        $exhibitProfileData = new Profile;
        $exhibitItemData = new Item;
    
        // 出品者ユーザー作成(出品１)
        $exhibitUserData = User::factory()->create();

        Storage::fake('storage');

        $path = UploadedFile::fake()->image('prof998.jpg')->store('storage');

        $exhibitProfileData = Profile::factory()->create([
            'user_id' => $exhibitUserData->id,
            'name' => 'testman1',
            'post_number' => '000-0000',
            'address' => '山口県山口市',
            'building' => 'アパート',
            'img_url' => $path,
            'prof_reg' => 1,
        ]);

        // 購入者ユーザーに購入される出品データを作成
        $pathExhibit = UploadedFile::fake()->image('item998.jpg')->store('storage');
        $exhibitItemData = Item::create([
            'user_id'     => $exhibitProfileData->user_id,
            'item_name'   => 'test商品',
            'brand_name'  => 'test',
            'price'       => 100,
            'discription' => '購入者ユーザーに購入される商品です',
            'soldout'     => 1,
            'status'      => 1,
            'img_url'     => $pathExhibit,        
        ]);
    }

    private function makePurchaseUserData()
    {
        global $exhibitItemData,
               $purchaseUserData, $purchaseProfileData, $purchaseItemData,
               $orderDatas;

        $purchaseUserData = new User;
        $purchaseProfileData = new Profile;
        $purchaseItemData = new Item;
        $orderDatas = new order_list;               

        // 購入者ユーザー作成(購入１、出品１)
        $purchaseUserData = User::factory()->create();

        Storage::fake('storage');

        $path = UploadedFile::fake()->image('prof999.jpg')->store('storage');

        $purchaseProfileData = Profile::create([
            'user_id' => $purchaseUserData->id, 
            'name' => 'testman2',
            'post_number' => '111-1111',
            'address' => '山口県山口市',
            'building' => 'アパート',
            'img_url' => $path,
            'prof_reg' => 1,
        ]);

        // 自身の出品データをデータベースに登録
        $pathPurchase = UploadedFile::fake()->image('item999.jpg')->store('storage');
        $purchaseItemData = Item::create([
            'user_id'     => $purchaseProfileData->user_id,
            'item_name'   => 'test商品2',
            'brand_name'  => 'test',
            'price'       => 100,
            'discription' => 'テストの商品です',
            'soldout'     => 0,
            'status'      => 1,
            'img_url'     => $pathPurchase,        
        ]);

        // 注文データを作成
        $orderDatas = Order_list::create([
            'user_id' => $purchaseItemData->user_id,
            'item_id' => $exhibitItemData->id,
            'purchase_method' => 1,
            'price'           => $exhibitItemData->price,
            'post_number'     => $purchaseProfileData->post_number,
            'address'         => $purchaseProfileData->address,
            'building'        => $purchaseProfileData->building,
            'order_state'     => 1,
        ]);    
    }
}
