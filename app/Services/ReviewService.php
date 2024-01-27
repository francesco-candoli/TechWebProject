<?php


namespace App\Services;

use App\Models\LikeActions;
use App\Models\User;
use App\Models\Review;
use App\Services\CommentService;
use App\Models\Comment;
use App\Services\UserService;
use App\Authentication\Session;

class ReviewService extends DatabaseService
{

  private $commentService;
  private $userService;
  private $restaurantService;
  private $photoService;

  function __construct()
  {
    parent::__construct();
    $this->commentService = new CommentService();
    $this->userService = new UserService();
    $this->restaurantService= new RestaurantService();
    $this->photoService = new PhotoService();
  }

  public function findReviewById(int $id)
  {
    $stmt = $this->connection->prepare("SELECT * FROM review WHERE id=?");
    $stmt->execute([$id]);
    $review = $stmt->fetch();
    if ($stmt->rowCount() == 0) {

      return null;
    }

    return new Review($review["id"], $review["content"], $review["vote"], $review["restaurant_id"], $review["publisher_id"]);

  }

  public function findByPublisher(User $publisher){

    
    $stmt = $this->connection->prepare("SELECT * FROM review WHERE publisher_id=?");
    $stmt->execute([$publisher->getID()]);
    
    if ($stmt->rowCount() == 0) {

      return null;
    }

    $counter=0;
    while($review = $stmt->fetch()){
      $reviews[$counter]=new Review($review["id"], $review["content"], $review["vote"], $review["restaurant_id"], $review["publisher_id"]);
      $counter++;
    }

    return $reviews;
  }

  private function insertReview(Review $review)
  {
    $stmt = $this->connection->prepare("INSERT INTO review (content, vote, restaurant_id, publisher_id) VALUES (?,?,?,?)")->execute([$review->getContent(), $review->getVote(), $review->getRestaurantId(), $review->getPublisherId()]);
  }

  private function updateReview(Review $review)
  {
    $stmt = $this->connection->prepare("UPDATE review SET content=?, vote=?, restaurant_id=?, publisher_id=? WHERE id=?")->execute([$review->getContent(), $review->getVote(), $review->getRestaurantId(), $review->getPublisherId(), $review->getId()]);
  }

  public function save(Review $review)
  {
    $res = $this->findReviewById($review->getId());
    if ($res == null) {
      $this->insertReview($review);
    } else {
      $this->updateReview($review);
    }

  }

  public function viewSerialize(Review $review)
  {

    $data=[
      'review' => $review,
      'photo' => $this->photoService->findPhotoByReviewId($review->getId()),
      'publisher' => $this->userService->findUserById($review->getPublisherId()),
      'restaurant' => $this->restaurantService->findRestaurantById($review->getRestaurantId()),
      'comments' => $this->findCommentsFromReview($review),
      'likes' => $this->getLike($review)
    ];

    return $data;
  }

  public function findLastRecent($quantity)
  {
    $stmt = $this->connection->prepare("SELECT * FROM review;");
    $stmt->execute();
    
    $i=0;
    $review=[];
    while($row = $stmt->fetch()) {
      $review[$i] = new Review($row["id"], $row["content"], $row["vote"], $row["restaurant_id"], $row["publisher_id"]);
      $i++;
    }
    return $review;
  }

  public function getLike(Review $review)
  {
    $stmt = $this->connection->prepare("SELECT * FROM like_actions WHERE review_id=?");
    $stmt->execute([$review->getId()]);
    

    if($stmt->rowCount() == 0) {
      return null;
    }
    $i=0;
    while($row = $stmt->fetch()) {
      $like[$i] = $this->userService->findUserById($row["user_id"]);
      $i++;
    }
    return $like;

  }

  public function findCommentsFromReview(Review $review){
    $stmt= $this->connection->prepare("SELECT * FROM comment WHERE review_id=?");
    $stmt->execute([$review->getId()]);
    if($stmt->rowCount() == 0) {
      return null;
    }
    $counter=0;
    $comments=[];
    while($comment = $stmt->fetch()){
        $comments[$counter]=new Comment($comment["id"], $comment["content"], $comment["review_id"], $comment["publisher_id"]);
        $counter++;
    }

    return $comments;

}
}