<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Profile;
use App\Models\Item;
use App\Models\Order_list;
use App\Models\Favorit;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TestId06ItemSearch extends TestCase
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

    protected function setUp():void
    {    
        parent::setUp();

        // 出品データを作成（出品者のデータも同時に作成）
        $this->makeExhibitUserData();
        $this->makePurchaseUserData();
    }

    /** @test */
    public function 商品検索機能_「商品名」で部分一致検索ができる()
    {
        global $exhibitItemData, $purchaseItemData;

        // 検索キーワードを入れてEnterキーを押す（送信）
        $response = $this->get('/?keyword=検索対象');
        $response->assertStatus(200);
        $response->assertViewIs('index');

        $response->assertSee("<span class=\"contents__current-page\">おすすめ</span>", false);

        // 検索結果商品を表示 1件
        $response->assertSee($exhibitItemData->item_name);
        $response->assertSee($exhibitItemData->img_url);

        // 検索にヒットしない商品
        $response->assertDontSee($purchaseItemData->item_name);
        $response->assertDontSee($purchaseItemData->img_url);
    }

    /** @test */
    public function 商品検索機能_検索状態がマイリストでも保持されている()
    {
        global $exhibitItemData, $purchaseUserData;

        // ログインページを開く
        $response = $this->post('/login',[
            'email'    => $purchaseUserData->email,
            'password' => 'password123', 
            ]);
        $response->assertStatus(302);
        $this->assertAuthenticatedAs($purchaseUserData);

        // 検索キーワードを入れてEnterキーを押す（送信）
        $response = $this->get('/?keyword=検索対象');
        $response->assertStatus(200);
        $response->assertViewIs('index');

        // 検索結果商品を表示 1件
        $response->assertSee($exhibitItemData->item_name);
        $response->assertSee($exhibitItemData->img_url);
        
        // 検索キーワードを入れてEnterキーを押す（送信）
        $response = $this->get('/?tag=mylist&keyword=検索対象');
        $response->assertStatus(200);
        $response->assertViewIs('mylist');   
        $response->assertSee('<span class="contents__current-page">マイリスト</span>', false);
        $searchKey = '<input type="text" name="keyword" id="kw" class="page-input-keyword" placeholder="なにをお探しですか？" value="検索対象">';
        $response->assertSee($searchKey, false);

        // 検索結果商品を表示 1件
        $response->assertSee($exhibitItemData->item_name);
        $response->assertSee($exhibitItemData->img_url);
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

        // 購入者ユーザーに検索される出品データを作成
        $pathExhibit = UploadedFile::fake()->image('item998.jpg')->store('storage');
        $exhibitItemData = Item::create([
            'user_id'     => $exhibitProfileData->user_id,
            'item_name'   => 'test商品検索対象',
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
        global $purchaseUserData, $purchaseProfileData, $purchaseItemData, $exhibitItemData,
               $orderDatas, $favoritDatas;

        $purchaseUserData = new User;
        $purchaseProfileData = new Profile;
        $purchaseItemData = new Item;
        $orderDatas = new Order_list;
        $favoritDatas = new Favorit;

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
            'item_id' => $exhibitItemData->id,
        ]);
    }
}