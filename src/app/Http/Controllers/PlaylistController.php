<?php

namespace App\Http\Controllers;

use App\Models\Playlist;
use Illuminate\Http\Request;

class PlaylistController extends Controller
{
    public function index()
    {
        return
            Playlist::withRelationships(request('with'))
            ->search(request('search'))
            ->orderBy(request('sort', 'created_at'), request('order', 'asc'))
            ->paginate(request('size', 10), ['*'], 'page', request('page', 1));
    }

    public function show(Playlist $playlist)
    {
        return
            $playlist->loadRelationships(request('with', []));
    }
}
