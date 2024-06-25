<?php

namespace App\Http\Controllers;

use App\Enums\Period;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index()
    {
        return Video::withRelationships(request('with'))
            ->fromPeriod(Period::tryFrom(request('period')))
            ->search(request('search'))
            ->orderBy(request('sort', 'created_at'), request('order', 'asc'))
            ->paginate(request('size', 10), ['*'], 'page', request('page', 1));
    }

    public function show(Video $video)
    {
        return $video->loadRelationships(request('with', []));
    }
}
