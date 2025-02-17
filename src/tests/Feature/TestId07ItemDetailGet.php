<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Profile;
use App\Models\Item;
use App\Models\Order_list;
use App\Models\Favorit;
use App\Models\Comment;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TestId07ItemDetailGet extends TestCase
{
    use RefreshDatabase;

    protected $exhibitUserData; 
    protected $exhibitProfileData;
    protected $exhibitItemData;
    protected $favoritItemData;
    protected $purchaseUserData;
    protected $purchaseProfileData;
    protected $purchaseItemData;
    protected $orderDatas;
    protected $favoritDatas;
    protected $commentDatas;

    protected function setUp():void
    {    
        parent::setUp();

        // 出品データを作成（出品者のデータも同時に作成）
        $this->makeExhibitUserData();
        $this->makePurchaseUserData();
    }

    /** @test */
    public function 商品詳細情報取得_必要な情報が表示される()
    {
        global $exhibitItemData, $favoritItemData, $favoritDatas, $commentDatas;

        // マイリストページ画面を開く
        $response = $this->get('/item/' . $favoritItemData->id);
        $response->assertStatus(200);
        $response->assertViewIs('detail');

        // 商品詳細の確認
        $imgTag = '<img class="item-sold-out__img" src="' . $favoritItemData->img_url . '" alt="' . $favoritItemData->item_name . '">';
        $response->assertSee($imgTag, false); 
        $response->assertSee('<p class="item-name">' . $favoritItemData->item_name . '</p>', false);
        $response->assertSee('<p class="brand-name">' . $favoritItemData->brand_name . '</p>', false);
        $response->assertSee('<p class="price">&yen;<span>' . number_format($favoritItemData->price), false);
        $response->assertSee('<figcaption class="favorit-count">1</figcaption>', false);
        $response->assertSee('<figcaption class="comment-count">1</figcaption>', false);

        // 残りの詳細を記載すること

    }

    private function makeExhibitUserData()
    {
        global $exhibitUserData, $exhibitProfileData, $exhibitItemData,  $favoritItemData;
        
        $exhibitUserData = new User;
        $exhibitProfileData = new Profile;
        $exhibitItemData = new Item;
        $favoritItemData = new Item;
    
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

        // 購入者ユーザーにいいね、コメントされる出品データを作成
        $pathFavorit = UploadedFile::fake()->image('item997.jpg')->store('storage');
        $favoritItemData = Item::create([
            'user_id'     => $exhibitProfileData->user_id,
            'item_name'   => 'testいいねコメント商品',
            'brand_name'  => 'test',
            'price'       => 100,
            'discription' => '購入者ユーザーにいいねされる商品です',
            'soldout'     => 1,
            'status'      => 1,
            'img_url'     => $pathFavorit,        
        ]);
    }

    private function makePurchaseUserData()
    {
        global $exhibitItemData, $favoritItemData,$purchaseUserData, $purchaseProfileData, $purchaseItemData,
               $orderDatas, $favoritDatas, $commentDatas;

        $purchaseUserData = new User;
        $purchaseProfileData = new Profile;
        $purchaseItemData = new Item;
        $orderDatas = new order_list;
        $favoritDatas = new favorit;         
        $commentDatas = new Comment;

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

        // いいねデータを作成
        $favoritDatas = Favorit::create([
            'user_id' => $purchaseItemData->user_id,
            'item_id' => $favoritItemData->id,
        ]);

        // コメントデータを作成
        $commentDatas = Comment::create([
            'user_id' => $purchaseItemData->user_id,
            'item_id' => $favoritItemData->id,
            'comment' => 'コメントしました。',
        ]);
    }
}
