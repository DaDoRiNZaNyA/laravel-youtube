<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return
            User::withRelationships(request('with'))
            ->search(request('search'))
            ->orderBy(request('sort', 'created_at'), request('order', 'asc'))
            ->paginate(request('size', 10), ['*'], 'page', request('page', 1));;
    }

    public function show(User $user)
    {
        return
            $user->loadRelationships(request('with', []));
    }
}
