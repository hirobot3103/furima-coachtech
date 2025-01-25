<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('status_lists', function (Blueprint $table) {
            $table->id();
            $table->string('status',255);
            $table->timestamp('create_at')->useCurrent()->nullable();
            $table->timestamp('updated_at')->useCurrent()->nullable();        
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('status_lists');
    }
};
