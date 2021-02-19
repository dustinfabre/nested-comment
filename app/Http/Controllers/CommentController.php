<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\CommentInterface;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{

    private $commentService;

    public function __construct(CommentInterface $commentService)
    {
        $this->commentService = $commentService;
    }

    public function index()
    {
        return response()->json(['comments' => $this->commentService->getAllComments()], 200);
    }

    public function addComment(Request $request)
    {
        $comment = $this->commentService->createComment($request->only(['user', 'comment']));
        return response()->json(['comment' => $comment], 200);
    }

    public function addReply(Request $request)
    {
        $comment = $this->commentService->createReply($request->only(['user', 'comment', 'parent_id']));
        return response()->json(['comment' => $comment], 200);
    }


}
