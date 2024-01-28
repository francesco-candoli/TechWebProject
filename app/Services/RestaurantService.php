<?php


namespace App\Services;

use App\Models\Restaurant;
use App\Authentication\Session;

class RestaurantService extends DatabaseService
{

   function __construct()
   {
      parent::__construct();
   }

   public function findRestaurantById(int $id)
   {
    $stmt = $this->connection->prepare("SELECT * FROM restaurant WHERE id=?");
    $stmt->execute([$id]);
    $restaurant = $stmt->fetch();
    if($stmt->rowCount()==0){
        return null;
    }
    return new Restaurant($restaurant["id"], $restaurant["name"], $restaurant["address"]);
 
   }

   public function findRestaurantByName(string $name)
   {
    $stmt = $this->connection->prepare("SELECT * FROM restaurant WHERE name=?");
    $stmt->execute([$name]);
    $restaurant = $stmt->fetch();
    if($stmt->rowCount()==0){
        return null;
    }
    return new Restaurant($restaurant["id"], $restaurant["name"], $restaurant["address"]);
 
   }

   private function insertRestaurant(Restaurant $restaurant){
    $stmt = $this->connection->prepare("INSERT INTO restaurant (name,address) VALUES (?,?)")->execute([$restaurant->getName(), $restaurant->getAddress()]);
   }

   private function updateRestaurant(Restaurant $restaurant){
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