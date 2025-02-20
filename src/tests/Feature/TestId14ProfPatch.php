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

class TestId14ProfPatch extends TestCase
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
    public function ユーザー情報変更_変更項目が初期値として過去設定されている()
    {
        global $purchaseUserData, $purchaseProfileData;

        // ログインユーザーしか画面に入れない
        $response = $this->get('/mypage/profile');
        $response->assertRedirect('/login');

        // ユーザーでログイン
        $this->actingAs($purchaseUserData);
        $this->assertAuthenticated();

        // プロフィール編集画面表示（変更前）
        $response = $this->get('/mypage/profile');
        $response->assertStatus(200);
        $response->assertViewIs('auth.edit-prof');

        $response->assertSee($purchaseProfileData->name);
        $response->assertSee($purchaseProfileData->post_number);
        $response->assertSee($purchaseProfileData->address);
        $response->assertSee($purchaseProfileData->building);

        // プロフィール情報を変更してみる
        $response = $this->patch('/mypage/profile',[
            'user_id'     => $purchaseProfileData->user_id,
            'name'        => 'newTwstman1',
            'post_number' => '333-3333',
            'address'     => '広島県広島市中区',
            'building'    => 'JJビル',
        ]);

        // プロフィール編集ページ初期表示(変更後)
        $response = $this->get('/mypage/profile');
        $response->assertStatus(200);
        $response->assertViewIs('auth.edit-prof');

        // 初期表示
        $response->assertSee('newTwstman1');
        $response->assertSee('333-3333');
        $response->assertSee('広島県広島市中区');
        $response->assertSee('JJビル'); 
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
