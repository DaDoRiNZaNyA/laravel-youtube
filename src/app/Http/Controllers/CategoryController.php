<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index()
    {
        return
            Category::withRelationships(request('with'))
            ->search(request('search'))
            ->orderBy(request('sort', 'created_at'), request('order', 'asc'))
            ->paginate(request('size', 10), ['*'], 'page', request('page', 1));
    }

    public function show(Category $category)
    {
        return $category->loadRelationships(request('with', []));
    }
}
