<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('item_id')->constrained('items');
            $table->string('comment',255);
            $table->timestamp('create_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
