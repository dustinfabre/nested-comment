<?php
namespace App\Contracts;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

interface CommentInterface {

    /**
     * Retrieve a comment by id
     *
     * @param integer $id
     * @return Comment
     */
    public function getComment(int $id) : Comment;

    /**
     * Retrieve all comments
     *
     * @return Collection
     */
    public function getAllComments() : Collection;

    /**
     * Create new record of reply
     *
     * @param array $data
     * @return Comment
     */
    public function createComment(array $data) : Comment;

    /**
     * Create new record of reply
     *
     * @param array $data
     * @return Comment
     */
    public function createReply(array $data) : Comment;
}
