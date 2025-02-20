<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Profile;
use App\Models\Item;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TestId12AddressUpdata extends TestCase
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
    public function 配送先変更機能_送付先住所変更画面にて登録した住所が商品購入画面に反映されている()
    {
        global $exhibitItemData, $purchaseUserData, $purchaseProfileData;

        // ログインページを開く
        $response = $this->post('/login',['email' => $purchaseUserData->email, 'password' => 'password123']);
        $this->assertAuthenticatedAs($purchaseUserData);

        // 商品購入画面を開く
        $response = $this->get('/purchase/' . $exhibitItemData->id);
        $response->assertStatus(200);
        $response->assertViewIs('purchase');

        // 送付先住所変更画面を開く
        $response = $this->get('/purchase/address/' . $exhibitItemData->id);
        $response->assertStatus(200);
        $response->assertViewIs('address');

        // 送付先住所を登録(送信)
        $response = $this->patch('/purchase/address/' . $exhibitItemData->id,[
            'user_id'         => $purchaseUserData->id,
            'name'            => $purchaseProfileData->name,
            'post_number'     => '099-9900',
            'address'         => '送付先県送付先市',
            'building'        => 'レジデンス送付先',
        ]);

        // 再度、商品購入画面を開く
        $response = $this->get('/purchase/address/' . $exhibitItemData->id);
        $response->assertStatus(200);
        $response->assertViewIs('address');

        // 変更後の配送先住所が表示されているか確認
        $response->assertSee('099-9900', false);
        $response->assertSee('送付先県送付先市', false);
        $response->assertSee('レジデンス送付先', false);
    }

    /** @test */
    public function 配送先変更機能_購入した商品に送付先住所が紐づいて登録される()
    {
        global $exhibitItemData, $purchaseUserData, $purchaseProfileData;

        // ログインページを開く
        $response = $this->post('/login',['email' => $purchaseUserData->email, 'password' => 'password123']);
        $this->assertAuthenticatedAs($purchaseUserData);

        // 商品購入画面を開く
        $response = $this->get('/purchase/' . $exhibitItemData->id);
        $response->assertStatus(200);
        $response->assertViewIs('purchase');

        // 送付先住所変更画面を開く
        $response = $this->get('/purchase/address/' . $exhibitItemData->id);
        $response->assertStatus(200);
        $response->assertViewIs('address');

        // 送付先住所を登録(送信)
        $response = $this->patch('/purchase/address/' . $exhibitItemData->id,[
            'user_id'         => $purchaseUserData->id,
            'name'            => $purchaseProfileData->name,
            'post_number'     => '099-9900',
            'address'         => '送付先県送付先市',
            'building'        => 'レジデンス送付先',
        ]);

        // 商品を選択して購入するボタン押下(送信)
        $response = $this->post('/purchase/' . $exhibitItemData->id,[
            'user_id'         => $purchaseUserData->id,
            'item_id'         => $exhibitItemData->id,
            'purchase_method' => 1,  // コンビニ支払い
            'price'           => $exhibitItemData->price,
            'post_number'     => '099-9900',
            'address'         => '送付先県送付先市',
            'building'        => 'レジデンス送付先',
            'order_state'     => 1,  // 決済手続き実施を示す
        ]);

        // 購入した商品に送付先住所が紐づいているか確認
        $this->assertDatabaseHas('order_lists', [
            'user_id'         => $purchaseUserData->id,
            'item_id'         => $exhibitItemData->id,
            'purchase_method' => 1,  // コンビニ支払い
            'price'           => $exhibitItemData->price,
            'post_number'     => '099-9900',
            'address'         => '送付先県送付先市',
            'building'        => 'レジデンス送付先',
            'order_state'     => 1,
        ]);
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
