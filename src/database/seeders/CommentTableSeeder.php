<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentTableSeeder extends Seeder
{
    public function run(): void
    {
        // コメント20件　対象商品、投稿者はランダム
        Comment::factory()->count(20)->create();
    }
}
