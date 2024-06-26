<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Error;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    public function index()
    {
        return Comment::with('parent', 'user', 'video')->get();
    }

    public function show(Comment $comment)
    {
        return
            $comment->loadRelationships(request('with', []));
    }

    public function store(Request $request)
    {
        auth()->loginUsingId(1);
        $attributes = $request->validate([
            'text' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id',
            'video_id' => 'required_without:parent_id|exists:videos,id'
        ]);

        $attributes['user_id'] = $request->user()->id;

        if ($request->parent_id) {
            $attributes['video_id'] = Comment::find($request->parent_id)->video_id;
        }

        return Comment::create($attributes);
    }

    public function update(Comment $comment, Request $request)
    {
        auth()->loginUsingId(1);
        abort_if($request->user()->isNot($comment->user), Response::HTTP_UNAUTHORIZED, 'Unauthorized');
        $attributes = $request->validate([
            'text' => 'required|string',
        ]);

        $comment->fill($attributes)->save();

        return $comment;
    }

    public function delete(Comment $comment, Request $request)
    {
        auth()->loginUsingId(1);
        abort_if($request->user()->isNot($comment->user), Response::HTTP_UNAUTHORIZED, 'Unauthorized');

        return Comment::destroy($comment->id);
    }
}
