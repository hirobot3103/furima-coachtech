<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('order_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('item_id')->constrained('items');
            $table->integer('purchase_method')->nullable(); // null or 0:未指定 1:コンビニ払い 2:カード払い
            $table->integer('price')->nullable();
            $table->string('post_number',255);
            $table->string('address',255);
            $table->string('building',255)->nullable();
            $table->integer('order_state');   // 0:購入手続き未完了 1:購入手続き処理完了
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('order_lists');
    }
};
