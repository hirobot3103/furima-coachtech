<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Profile;
use App\Models\Item;
use App\Models\Order_list;
use App\Models\Favorit;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Status_list;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TestId09CommentSet extends TestCase
{
    use RefreshDatabase;

    protected $exhibitUserData; 
    protected $exhibitProfileData;
    protected $favoritItemData;
    protected $purchaseUserData;
    protected $purchaseProfileData;
    protected $purchaseItemData;
    protected $favoritDatas;
    protected $commentDatas;
    protected $categoryDatas;
    protected $statusDatas;

    protected function setUp():void
    {    
        parent::setUp();

        // 出品データを作成（出品者のデータも同時に作成）
        $this->makeExhibitUserData();
        $this->makePurchaseUserData();
    }

    /** @test */
    public function コメント送信機能_ログイン済みのユーザーはコメントを送信できる()
    {
        global $purchaseUserData, $favoritItemData;

        // ログインページを開く
        $response = $this->post('/login',['email' => $purchaseUserData->email, 'password' => 'password123']);
        $this->assertAuthenticatedAs($purchaseUserData);

        // 商品詳細ページを開く
        $response = $this->get('/item/' . $favoritItemData->id);
        $response->assertStatus(200);
        $response->assertViewIs('detail');

        $response->assertSee('<figcaption class="comment-count">1</figcaption>', false);  // コメント数初期表示

        // コメントを入力(送信)
        $response = $this->post('/item/' . $favoritItemData->id,[
            'commentReg' => 1,  // 送信ボタン押下を示す
            'user_id'    => $purchaseUserData->id,
            'item_id'    => $favoritItemData->id,
            'comment'    => 'これはコメント入力のテストです' // コメント内容
        ]);

        $response = $this->get('/item/' . $favoritItemData->id);

        // コメントは登録され、コメント数合が増加表示される
        $this->assertDatabaseHas('comments', [
            'user_id'    => $purchaseUserData->id,
            'item_id'    => $favoritItemData->id,
            'comment'    => 'これはコメント入力のテストです'
        ]);

        $response->assertSee('<figcaption class="comment-count">2</figcaption>', false);  // コメント送信後
    }

    /** @test */
    public function コメント送信機能_ログイン前のユーザーはコメントを送信できない()
    {
        global $favoritItemData;

        // ログインしていない
        $this->assertGuest();

        // 商品詳細ページを開く
        $response = $this->get('/item/' . $favoritItemData->id);
        $response->assertStatus(200);
        $response->assertViewIs('detail');

        // ログインしていない場合、コメント入力欄、送信欄が表示されないので送信できない 
        $response->assertDontSee('<textarea name="comment" id="" class="comment__input">', false);  // コメント入力欄
        $response->assertDontSee('<button name="commentReg" class="post-btn" type="submit" value=1 id="commentReg">コメントを送信する</button>', false);  // コメント送信ボタン
    }

    /** @test */
    public function コメント送信機能_コメントが入力されていない場合バリデーションメッセージが表示される()
    {
        global $purchaseUserData, $favoritItemData;

        // ログインページを開く
        $response = $this->post('/login',['email' => $purchaseUserData->email, 'password' => 'password123']);
        $this->assertAuthenticatedAs($purchaseUserData);

        // 商品詳細ページを開く
        $response = $this->get('/item/' . $favoritItemData->id);
        $response->assertStatus(200);
        $response->assertViewIs('detail');

        // コメントを入力(送信)
        $response = $this->post('/item/' . $favoritItemData->id,[
            'commentReg' => 1,  // 送信ボタン押下を示す
            'user_id'    => $purchaseUserData->id,
            'item_id'    => $favoritItemData->id,
            'comment'    => '' // コメント内容なし
        ]);

        // バリデーションエラー発生とメッセージ内容確認
        $response->assertSessionHasErrors(['comment' => 'コメントを入力してください']);
    }

    /** @test */
    public function コメント送信機能_コメントが255字以上の場合バリデーションメッセージが表示される()
    {
        global $purchaseUserData, $favoritItemData;

        // ログインページを開く
        $response = $this->post('/login',['email' => $purchaseUserData->email, 'password' => 'password123']);
        $this->assertAuthenticatedAs($purchaseUserData);

        // 商品詳細ページを開く
        $response = $this->get('/item/' . $favoritItemData->id);
        $response->assertStatus(200);
        $response->assertViewIs('detail');

        // コメントを入力(送信)
        $response = $this->post('/item/' . $favoritItemData->id,[
            'commentReg' => 1,  // 送信ボタン押下を示す
            'user_id'    => $purchaseUserData->id,
            'item_id'    => $favoritItemData->id,
            'comment'    => str_repeat('x',256), // コメント256文字で入力
        ]);

        // バリデーションエラー発生とメッセージ内容確認
        $response->assertSessionHasErrors(['comment' => 'コメントは255文字以内で入力して下さい']);
    }

    private function makeExhibitUserData()
    {
        global $exhibitUserData, $exhibitProfileData, $favoritItemData;
        
        $exhibitUserData = new User;
        $exhibitProfileData = new Profile;
        $favoritItemData = new Item;
    
        // 出品者ユーザー作成
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

        // 購入者ユーザーにいいね、コメントされる出品データを作成
        $pathFavorit = UploadedFile::fake()->image('item997.jpg')->store('storage');
        $favoritItemData = Item::create([
            'user_id'     => $exhibitProfileData->user_id,
            'item_name'   => 'testいいねコメント商品',
            'brand_name'  => 'test',
            'price'       => 100,
            'discription' => '購入者ユーザーにいいねされる商品です',
            'soldout'     => 0,
            'status'      => 1,
            'img_url'     => $pathFavorit,        
        ]);
    }

    private function makePurchaseUserData()
    {
        global $favoritItemData,$purchaseUserData, $purchaseProfileData, $purchaseItemData,
               $orderDatas, $favoritDatas, $commentDatas, $categoryDatas, $statusDatas;

        $purchaseUserData = new User;
        $purchaseProfileData = new Profile;
        $purchaseItemData = new Item;
        $orderDatas = new order_list;
        $favoritDatas = new favorit;         
        $commentDatas = new Comment;
        $categoryDatas = new Category;

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

        // コメントデータを作成
        $commentDatas = Comment::create([
            'user_id' => $purchaseItemData->user_id,
            'item_id' => $favoritItemData->id,
            'comment' => 'コメントしました。',
        ]);

        // カテゴリーデータ（カテゴリー2件ファッションと家電を選択） 
        $categoryDatas = Category::insert([
           [
            'item_id' => $favoritItemData->id,
            'category_id' => 1,
           ], 
           [
            'item_id' => $favoritItemData->id,
            'category_id' => 2,
           ],
        ]);

        // 商品の状態データ
        $statusDatas = Status_list::where('id', $favoritItemData->status)->first();
    }
}
