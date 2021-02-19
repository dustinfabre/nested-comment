<?php
namespace App\Services;

use App\Models\Comment;
use App\Contracts\CommentInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;


class CommentService  implements CommentInterface {


    /**
     * Retrieve a comment by id
     *
     * @param integer $id
     * @return App\Models\Comment
     */
    public function getComment(int $id) : Comment
    {
        return Comment::find($id);
    }

    /**
     * Retrieve all comments
     *
     * @return Illuminate\Database\Eloquent\Collection
     */
    public function getAllComments() : Collection
    {
        return Comment::where('parent_id', null)->with(['replies' => function($query) {
            return $query->orderBy('created_at', 'desc')->with(['replies' => function($query) {
                return $query->orderBy('created_at', 'desc');
            }]);
        }])
        ->orderBy('created_at', 'desc')
        ->get();
    }

    /**
     * Create new record of reply
     *
     * @param array $data
     * @return App\Models\Comment
     */
    public function createComment(array $data) : Comment
    {
        $comment = new Comment();

        $comment->user = $data['user'];
        $comment->comment = $data['comment'];
        $comment->parent_id = $data['parent_id'] ?? null;
        $comment->save();

        return $comment->load('replies');;
    }

    /**
     * Create new record of reply
     *
     * @param array $data
     * @return App\Models\Comment
     */
    public function createReply(array $data) : Comment
    {

        $reply = $this->createComment($data);

        return $reply;
    }


}
