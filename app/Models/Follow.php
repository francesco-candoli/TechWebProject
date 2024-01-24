<?php

namespace App\Models;

class Follow{
    private int $following_user_id;
    private int $followed_user_id;

    function __construct(int $following_user_id, int $followed_user_id){
        $this->following_user_id=$following_user_id;
        $this->followed_user_id=$followed_user_id;
    }

    public function getFollowingUserId(){
        return $this->following_user_id;
    }

    public function getFollowedUserId(){
        return $this->followed_user_id;
    }

}
