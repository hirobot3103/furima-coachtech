<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('item_name',255);
            $table->string('brand_name',255)->nullable();
            $table->integer('price');
            $table->string('discription',255);
            $table->integer('soldout');
            $table->foreignId('status')->constrained('status_lists');
            $table->string('img_url',255);
            $table->timestamp('created_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();
       });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};
