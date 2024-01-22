<?php


namespace App\Services;

use App\Models\Review;
use App\Authentication\Session;

class ReviewService extends DatabaseService
{

    function __construct()
    {
        parent::__construct();
    }

    
    public function findByPublisherId(int $id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM review WHERE publisher_id=?");
        $stmt->execute([$id]);
        $review = $stmt->fetch();
        for ($i = 0; $i < count($review); $i++) {
            $review[$i] = new Review($review[$i]["id"], $review[$i]["content"], $review[$i]["vote"], $review[$i]["restaurant_id"], $review[$i]["publisher_id"]);
        }
    }

    public function save(Review $review)
    {
        if(!$this->isPresent($review->getId())) $this->updateReview($review);
        else $this->insertReview($review);
    }

    private function isPresent(int $id)
    {
        $stmt = $this->connection->prepare("SELECT * FROM review WHERE id=?");
        $stmt->execute([$id]);
        if($stmt->fetch()===false){
            return false;
        }else{
            return true;
        }
    }

    private function insertReview(Review $review){
        $stmt = $this->connection->prepare("INSERT INTO review (content, vote, restaurant_id, publisher_id) VALUES (?, ?, ?, ?)");
        $stmt->execute(array($review->getContent(), $review->getVote(), $review->getRestaurantId(), $review->getPublisherId()));
    }

    private function updateReview(Review $review){
        $stmt = $this->connection->prepare("UPDATE review SET content = ?, vote = ?, restaurant_id = ?, publisher_id = ?");
        $stmt->execute(array($review->getContent(), $review->getVote(), $review->getRestaurantId(), $review->getPublisherId()));
    }

    public function getCasualReview(int $n)
    {
        $stmt = $this->connection->prepare("SELECT * FROM review ORDER BY RAND() LIMIT ?");
        $stmt->execute($n);
        $review = $stmt->fetch();
        for($i=0; $i<count($review); $i++)
        { 
            $casualReviews[$i] = new Review($review[$i]["id"], $review[$i]["content"], $review[$i]["vote"], $review[$i]["restaurant_id"], $review[$i]["publisher_id"]);
        }

        return $casualReviews;
    }
}