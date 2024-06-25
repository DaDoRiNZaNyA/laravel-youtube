<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $comments = [];

        foreach (range(1, 3) as $i) {
            $comments[] = [
                'text' => "comment $i",
                'user_id' => $i,
                'video_id' => $i
            ];
        }

        DB::table('comments')->insert($comments);
    }
}
