<?php


namespace App\Services;

use App\Models\Review;
use App\Services\CommentService;
use App\Services\UserService;
use App\Authentication\Session;

class ReviewService extends DatabaseService
{

   function __construct()
   {
      parent::__construct();
   }

   public function findReviewById(int $id)
   {
    $stmt = $this->connection->prepare("SELECT * FROM review WHERE id=?");
    $stmt->execute([$id]);
    $review= $stmt->fetch();
    if($stmt->rowCount()==0){
        return null;
    }
    return new Review($review["id"], $review["content"], $review["vote"], $review["restaurant_id"], $review["publisher_id"]);
 
   }

   private function insertReview(Review $review){
    $stmt = $this->connection->prepare("INSERT INTO review (content, vote, restaurant_id, publisher_id) VALUES (?,?,?,?)")->execute([$review->getContent(), $review->getVote(), $review->getRestaurantId(), $review->getPublisherId()]);
   }

   private function updateReview(Review $review){
    $stmt = $this->connection->prepare("UPDATE review SET content=?, vote=?, restaurant_id=?, publisher_id=? WHERE id=?")->execute([$review->getContent(), $review->getVote(), $review->getRestaurantId(), $review->getPublisherId(), $review->getId()]);
   }

   public function save(Review $review){
    $res= $this->findReviewById($review->getId());
    if($res==null){
        $this->insertReview($review);
    }else{
        $this->updateReview($review);
    }
    
   }


   public function viewSerialize(Review $review){




   }
}