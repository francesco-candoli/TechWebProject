<?php


namespace App\Services;

use App\Models\Comment;
use App\Services\UserService;
use App\Authentication\Session;

class CommentService extends DatabaseService
{


    function __construct()
    {
        parent::__construct();
    }

    public function findCommentById(int $id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM comment WHERE id=?");
        $stmt->execute([$id]);
        $comment = $stmt->fetch();
        if ($stmt->rowCount() == 0) {
            return null;
        }
        return new Comment($comment["id"], $comment["content"], $comment["review_id"], $comment["publisher_id"]);


    }

    private function insertComment(Comment $comment)
    {
        $stmt = $this->connection->prepare("INSERT INTO photo (content, review_id, publisher_id) VALUES (?,?,?)")->execute([$comment->getContent(), $comment->getReviewId(), $comment->getPublisherId()]);
    }

    private function updateComment(Comment $comment)
    {
        $stmt = $this->connection->prepare("UPDATE photo SET content=?, review_id=?, publisher_id=? WHERE id=?")->execute([$comment->getContent(), $comment->getReviewId(), $comment->getPublisherId(), $comment->getId()]);
    }

    public function save(Comment $comment)
    {
        $res = $this->findCommentById($comment->getId());
        if ($res == null) {
            $this->insertComment($comment);
        } else {
            $this->updateComment($comment);
        }

    }

    public function getLikeCount(Comment $comment)
    {
        $stmt = $this->connection->prepare("SELECT * FROM like_actions WHERE comment_id=?");

        $stmt->execute([$comment->getId()]);

        while ($row = $stmt->fetch()) {

        }
    }
}