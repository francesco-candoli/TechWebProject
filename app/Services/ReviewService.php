<?php


namespace App\Services;

use App\Models\User;
use App\Models\Review;
use App\Models\Comment;
use App\Services\CommentService;
use App\Services\LikeActionsService;
use App\Services\UserService;
use App\Authentication\Session;

class ReviewService extends DatabaseService
{

  private $commentService;
  private $userService;
  private $restaurantService;
  private $photoService;
  private $likeActionsService;

  function __construct()
  {
    parent::__construct();
    $this->commentService = new CommentService();
    $this->userService = new UserService();
    $this->restaurantService= new RestaurantService();
    $this->photoService = new PhotoService();
    $this->likeActionsService = new LikeActionsService();
  }

  public function findReviewById(int $id)
  {
    $stmt = $this->connection->prepare("SELECT * FROM review WHERE id=?");
    $stmt->execute([$id]);
    $review = $stmt->fetch();
    if ($stmt->rowCount() == 0) {

      return null;
    }

    return new Review($review["id"], $review["content"], $review["vote"], $review["restaurant_id"], $review["publisher_id"], $review["date"]);

  }

  public function findByPublisher(User $publisher){

    
    $stmt = $this->connection->prepare("SELECT * FROM review WHERE publisher_id=?");
    $stmt->execute([$publisher->getID()]);
    
    if ($stmt->rowCount() == 0) {

      return null;
    }

    $counter=0;
    while($review = $stmt->fetch()){
      $reviews[$counter]=new Review($review["id"], $review["content"], $review["vote"], $review["restaurant_id"], $review["publisher_id"], $review["date"]);
      $counter++;
    }

    return $reviews;
  }

  private function insertReview(Review $review)
  {
    $stmt = $this->connection->prepare("INSERT INTO review (content, vote, restaurant_id, publisher_id, date) VALUES (?,?,?,?,CURDATE());")->execute([$review->getContent(), $review->getVote(), $review->getRestaurantId(), $review->getPublisherId()]);
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
      return $this->connection->lastInsertId();
    } else {
      $this->updateReview($review);
      return $review->getId();
    }

  }

  public function viewSerialize(Review $review)
  {


    $comments=$this->findCommentsFromReview($review);

    if($comments !=  null){
      foreach($comments as $comment){
        $comment->setContent($this->userService->findUserById($comment->getPublisherId())->getUsername().": ".$comment->getContent());
      }
    }

    $data=[
      'review' => $review,
      'photo' => $this->photoService->findPhotoByReviewId($review->getId()),
      'publisher' => $this->userService->findUserById($review->getPublisherId()),
      'restaurant' => $this->restaurantService->findRestaurantById($review->getRestaurantId()),
      'comments' =>  $comments,
      'likes' => $this->getLike($review),
      'liked' => $this->likeActionsService->isReviewLikedByLoggedUser($review->getId())
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
      $review[$i] = new Review($row["id"], $row["content"], $row["vote"], $row["restaurant_id"], $row["publisher_id"], $row["date"]);
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

  public function getLastId(){
    $stmt = $this->connection->prepare("SELECT * FROM review ORDER BY id DESC");
    $stmt->execute();
    $review = $stmt->fetch();

    return $review["id"];
  }
}