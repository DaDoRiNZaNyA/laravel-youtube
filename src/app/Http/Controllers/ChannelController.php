<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    public function index()
    {
        return
            Channel::withRelationships(request('with'))
            ->search(request('search'))
            ->orderBy(request('sort', 'created_at'), request('order', 'asc'))
            ->paginate(request('size', 10), ['*'], 'page', request('page', 1));
    }

    public function show(Channel $channel)
    {
        return
            $channel->loadRelationships(request('with', []));
    }
}
