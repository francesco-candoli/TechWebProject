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

    private function insertComment(Comment $comment){
        $stmt = $this->connection->prepare("INSERT INTO comment (content, review_id, publisher_id) VALUES (?,?)")->execute([$comment->getContent(), $comment->getReviewId(), $comment->getPublisherId()]);
       }
    
       private function updateComment(Comment $comment){
        $stmt = $this->connection->prepare("UPDATE restaurant SET name=?, address=? WHERE id=?")->execute([ $restaurant->getName(), $restaurant->getAddress(), $restaurant->getId()]); 
       }
    
       public function save(Restaurant $restaurant){
        $res= $this->findRestaurantById($restaurant->getId());
        if($res==null){
            $this->insertRestaurant($restaurant);
        }else{
            $this->updateRestaurant($restaurant);
        }
        
       }
 
    
   
}