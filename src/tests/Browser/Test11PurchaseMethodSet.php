<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Item;
use App\Models\Order_list;
use App\Models\Status_list;
use App\Models\Profile;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\DatabaseMigrations;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class Test11PurchaseMethodSet extends DuskTestCase
{
    use DatabaseMigrations;

    /** @test */
    public function 支払い方法選択機能_小計画面で変更が即時反映される()
    {
        // テスト用ログインユーザー作成
        $user = User::factory()->create([
            'email' => 'testuser@example.com',
            'password' => bcrypt('password'),
        ]);
        Storage::fake('storage');
        $path = UploadedFile::fake()->image('prof998.jpg')->store('storage');
        $purchaseProfileData = Profile::create([
            'user_id' => $user->id, 
            'name' => 'testman',
            'post_number' => '111-1111',
            'address' => '山口県山口市',
            'building' => 'アパート',
            'img_url' => $path,
            'prof_reg' => 1,
        ]);
        $userExhibit = User::factory()->create([
            'email' => 'testuser2@example.com',
            'password' => bcrypt('password2'),
        ]);

        // テスト用商品データを作成
        $statusDatas = Status_list::create([
            'status' => '良好' ,
        ]);

        Storage::fake('storage');
        $pathExhibit = UploadedFile::fake()->image('item998.jpg')->store('storage');
        $exhibitItemData = Item::create([
            'user_id'     => $userExhibit->id,
            'item_name'   => 'test商品',
            'brand_name'  => 'test',
            'price'       => 100,
            'discription' => '購入者ユーザーに購入される商品です',
            'soldout'     => 0,
            'status'      => $statusDatas->id,
            'img_url'     => $pathExhibit,        
        ]);       
 
        // 注文データを作成
        $orderDatas = Order_list::create([
            'user_id' => $user->id,
            'item_id' => $exhibitItemData->id,
            'purchase_method' => 1,
            'price'           => $exhibitItemData->price,
            'post_number'     => '111-1111',
            'address'         => 'testDusk県testDusk市',
            'building'        => 'DuskHall',
            'order_state'     => 0,
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            // $this->browse(function (Browser $browser){

            // ログインする
            $browser->visit('/login')
                ->waitFor('button[type="submit"]', 5)
                ->type('email', $user->email)
                ->type('password', 'password')
                ->click('button[type="submit"]')
            // $browser->loginAs($user)
                    // ->visit('/purchase/' . $exhibitItemData->id)  // テストするURL
                    // ->visit('/')  // テストするURL
                    // dd($browser->visit('/'));
                    // ->assertSee('おすすめ')
                    ->screenshot('filename1');
                    // ->select('method_selector', '1')
                    // ->waitForText('コンビニ払い')  // JS動作後の変化を確認
                    // ->assertSee('コンビニ払い');        
        });

        // 小計欄の支払い方法の表示に反映されるか確認

    }
}
