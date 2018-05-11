<?php

namespace Optimus\Posts\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Optimus\Posts\PostComment;

class PostCommentsController extends Controller
{
    public function index(Request $request)
    {
        $comments = PostComment::all();

        return PostCommentResource::collection($comments);
    }

    public function show($id)
    {
        $comment = PostComment::findOrFail($id);

        return new PostCommentResource($comment);
    }

    public function destroy($id)
    {
        PostComment::findOrFail($id)->delete();

        return response(null, 204);
    }
}
