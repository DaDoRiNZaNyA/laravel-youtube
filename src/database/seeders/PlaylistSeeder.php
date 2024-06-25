<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlaylistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $playlists = [];

        foreach (range(1, 3) as $i) {
            $playlists[] = [
                'name' => "Playlist $i",
                'channel_id' => $i
            ];
        }

        DB::table('playlists')->insert($playlists);
    }
}
