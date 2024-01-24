<?php


namespace App\Services;

use App\Models\Comment;
use App\Models\Review;
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

 
    
   
}