<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Post::create([
            'title' => 'My first post',
            'body' => 'シーダーのテストです',
            'user_id' => 1,
        ]);
    }
}
