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

class TestId13ProfGet extends TestCase
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
    public function ユーザー情報取得_必要な情報が取得できる()
    {
        global $exhibitItemData, $purchaseUserData, $purchaseProfileData, $purchaseItemData;

        // ログインユーザーしか画面に入れない
        $response = $this->get('/mypage');
        $response->assertRedirect('/login');

        // 購入者ユーザーでログイン
        $this->actingAs($purchaseUserData);
        $this->assertAuthenticated();

        // プロフィールページ初期表示（マイページ）を開く
        // 想定：購入した商品タグが選択されており、購入した商品が表示されている
        $response = $this->get('/mypage');
        $response->assertStatus(200);

        $response->assertSee("<span class=\"contents__current-page\">購入した商品</span>", false);
        $response->assertSee($purchaseProfileData->name);
        $response->assertSee($purchaseProfileData->img_url);
        $response->assertSee($exhibitItemData->item_name);
        $response->assertSee($exhibitItemData->img_url);

        // 購入した商品ページを表示
        $response = $this->get('/mypage?tag=buy');
        $response->assertStatus(200);

        $response->assertSee("<span class=\"contents__current-page\">購入した商品</span>", false);
        $response->assertSee($purchaseProfileData->name);
        $response->assertSee($purchaseProfileData->img_url);
        $response->assertSee($exhibitItemData->item_name);
        $response->assertSee($exhibitItemData->img_url);

        // 購入した商品ページを開く
        $response = $this->get('/mypage?tag=sell');
        $response->assertStatus(200);

        $response->assertSee('<span class="contents__current-page" >出品した商品</span>', false);
        $response->assertSee($purchaseProfileData->name);
        $response->assertSee($purchaseProfileData->img_url);
        $response->assertSee($purchaseItemData->item_name);
        $response->assertSee($purchaseItemData->img_url); 
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
