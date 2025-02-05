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
            $table->integer('purchase_method');
            $table->string('price',255);
            $table->string('post_number',255);
            $table->string('address',255);
            $table->string('building',255)->nullable();
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('order_lists');
    }
};
