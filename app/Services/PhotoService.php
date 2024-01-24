<?php


namespace App\Services;

use App\Models\Photo;
use App\Authentication\Session;

class PhotoService extends DatabaseService
{

   function __construct()
   {
      parent::__construct();

   }

   public function findPhotoById(int $id)
   {
    $stmt = $this->connection->prepare("SELECT * FROM photo WHERE id=?");
    $stmt->execute([$id]);
    $photo = $stmt->fetch();
    if($stmt->rowCount()==0){
        return null;
    }
    return new Photo($photo["id"], $photo["src"], $photo["alt"], $photo["review_id"]);
 
 
   }

   private function insertPhoto(Photo $photo){
    $stmt = $this->connection->prepare("INSERT INTO photo (src, alt, review_id) VALUES (?,?,?)")->execute([$photo->getSrc(), $photo->getAlt(), $photo->getReviewId()]);
   }

   private function updatePhoto(Photo $photo){
    $stmt = $this->connection->prepare("UPDATE restaurant SET src=?, alt=?, review_id=? WHERE id=?")->execute([$photo->getSrc(), $photo->getAlt(), $photo->getReviewId()]); 
   }

   public function save(Photo $photo){
    $res= $this->findPhotoById($photo->getId());
    if($res==null){
        $this->insertPhoto($photo);
    }else{
        $this->updatePhoto($photo);
    }
    
   }
}