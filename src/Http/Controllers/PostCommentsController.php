<?php

namespace Optimus\Posts\Http\Controllers;

use Illuminate\Routing\Controller;
use Optimus\Posts\PostComment;

class PostCommentsController extends Controller
{
    public function index()
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
