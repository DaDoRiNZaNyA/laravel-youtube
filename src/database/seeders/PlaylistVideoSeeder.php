<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlaylistVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $playlistVideo = [];

        foreach (range(1, 3) as $i) {
            $playlistVideo[] = [
                'playlist_id' => $i,
                'video_id' => $i,
                'channel_id' => $i
            ];
        }

        DB::table('playlist_video')->insert($playlistVideo);
    }
}
