<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Profile;
use App\Models\Item;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TestId10Purchase extends TestCase
{
    use RefreshDatabase;

    protected $exhibitUserData; 
    protected $exhibitProfileData;
    protected $exhibitItemData;
    protected $purchaseUserData;
    protected $purchaseProfileData;
    protected $purchaseItemData;

    protected function setUp():void
    {    
        parent::setUp();

        // 出品データを作成（出品者のデータも同時に作成）
        $this->makeExhibitUserData();
        $this->makePurchaseUserData();
        
    }

    /** @test */
    public function 商品購入機能_「購入する」ボタンを押下すると購入が完了する()
    {
        global $exhibitItemData, $purchaseUserData, $purchaseProfileData;

        // ログインページを開く
        $response = $this->post('/login',['email' => $purchaseUserData->email, 'password' => 'password123']);
        $this->assertAuthenticatedAs($purchaseUserData);

        // 商品購入画面を開く
        $response = $this->get('/purchase/' . $exhibitItemData->id);
        $response->assertStatus(200);
        $response->assertViewIs('purchase');

        // 商品を選択して購入するボタン押下(送信)
        $response = $this->post('/purchase/' . $exhibitItemData->id,[
            'user_id'         => $purchaseUserData->id,
            'item_id'         => $exhibitItemData->id,
            'purchase_method' => 1,  // コンビニ支払い
            'price'           => $exhibitItemData->price,
            'post_number'     => $purchaseProfileData->post_number,
            'address'         => $purchaseProfileData->address,
            'building'        => $purchaseProfileData->building,
            'order_state'     => 1,  // 決済手続き実施を示す
        ]);

        // 購入完了
        // テーブルに登録されているか確認
        $this->assertDatabaseHas('order_lists', [
            'user_id'         => $purchaseUserData->id,
            'item_id'         => $exhibitItemData->id,
            'purchase_method' => 1,
            'price'           => $exhibitItemData->price,
            'post_number'     => $purchaseProfileData->post_number,
            'address'         => $purchaseProfileData->address,
            'building'        => $purchaseProfileData->building,
            'order_state'     => 1,  // 決済手続き実施を示す
        ]);
    }

    /** @test */
    public function 商品購入機能_購入した商品は商品一覧画面にて「sold」と表示される()
    {
        global $exhibitItemData, $purchaseUserData, $purchaseProfileData;

        // ログインページを開く
        $response = $this->post('/login',['email' => $purchaseUserData->email, 'password' => 'password123']);
        $this->assertAuthenticatedAs($purchaseUserData);

        // 商品購入画面を開く
        $response = $this->get('/purchase/' . $exhibitItemData->id);
        $response->assertStatus(200);
        $response->assertViewIs('purchase');

        // 商品を選択して購入するボタン押下(送信)
        $response = $this->post('/purchase/' . $exhibitItemData->id,[
            'user_id'         => $purchaseUserData->id,
            'item_id'         => $exhibitItemData->id,
            'purchase_method' => 1,  // コンビニ支払い
            'price'           => $exhibitItemData->price,
            'post_number'     => $purchaseProfileData->post_number,
            'address'         => $purchaseProfileData->address,
            'building'        => $purchaseProfileData->building,
            'order_state'     => 1,  // 決済手続き実施を示す
        ]);

        // 購入完了
        // テーブルに登録されているか確認
        $this->assertDatabaseHas('order_lists', [
            'user_id'         => $purchaseUserData->id,
            'item_id'         => $exhibitItemData->id,
            'purchase_method' => 1,
            'price'           => $exhibitItemData->price,
            'post_number'     => $purchaseProfileData->post_number,
            'address'         => $purchaseProfileData->address,
            'building'        => $purchaseProfileData->building,
            'order_state'     => 1,  // 決済手続き実施を示す
        ]);

        // 商品一覧を表示し、当該商品が「Soldout」となっているか確認
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertViewIs('index');

        $imgTagProperty = ' src="http://localhost/' . $exhibitItemData->img_url .'" alt="商品名:'. $exhibitItemData->item_name . '"';
        $response->assertSee('<img class="item-sold-out__img"' . $imgTagProperty . '>', false );

    }

    /** @test */
    public function 商品購入機能_プロフィールの「購入した商品一覧」に追加されている()
    {
        global $exhibitItemData, $purchaseUserData, $purchaseProfileData;

        // ログインページを開く
        $response = $this->post('/login',['email' => $purchaseUserData->email, 'password' => 'password123']);
        $this->assertAuthenticatedAs($purchaseUserData);

        // 商品購入画面を開く
        $response = $this->get('/purchase/' . $exhibitItemData->id);
        $response->assertStatus(200);
        $response->assertViewIs('purchase');

        // 商品を選択して購入するボタン押下(送信)
        $response = $this->post('/purchase/' . $exhibitItemData->id,[
            'user_id'         => $purchaseUserData->id,
            'item_id'         => $exhibitItemData->id,
            'purchase_method' => 1,  // コンビニ支払い
            'price'           => $exhibitItemData->price,
            'post_number'     => $purchaseProfileData->post_number,
            'address'         => $purchaseProfileData->address,
            'building'        => $purchaseProfileData->building,
            'order_state'     => 1,  // 決済手続き実施を示す
        ]);

        // 購入完了
        // テーブルに登録されているか確認
        $this->assertDatabaseHas('order_lists', [
            'user_id'         => $purchaseUserData->id,
            'item_id'         => $exhibitItemData->id,
            'purchase_method' => 1,
            'price'           => $exhibitItemData->price,
            'post_number'     => $purchaseProfileData->post_number,
            'address'         => $purchaseProfileData->address,
            'building'        => $purchaseProfileData->building,
            'order_state'     => 1,  // 決済手続き実施を示す
        ]);

        // 商品一覧を表示し、当該商品が「Soldout」となっているか確認
        $response = $this->get('/mypage?tag=buy');
        $response->assertStatus(200);
        $response->assertViewIs('auth.profsell');

        $imgTagProperty = ' src="http://localhost/' . $exhibitItemData->img_url .'" alt="商品名:'. $exhibitItemData->item_name . '"';
        $response->assertSee('<img class="item-sold-out__img"' . $imgTagProperty . '>', false );
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
            'soldout'     => 0,
            'status'      => 1,
            'img_url'     => $pathExhibit,        
        ]);
    }

    private function makePurchaseUserData()
    {
        global $purchaseUserData, $purchaseProfileData, $purchaseItemData;

        $purchaseUserData = new User;
        $purchaseProfileData = new Profile;
        $purchaseItemData = new Item;

        // 購入者ユーザー作成(出品１)
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
    }
}
