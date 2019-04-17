<?php
////////*******************   USERS    ********************************
/*
$user = $twilio->chat->v2->services("ISf3057fcd46c2488aa0a7882e464263a7")
                         ->users
                         ->create("josea3712");

print($user->sid);
*/
//////////////*************  ADD MEMBER AT CHANNEL  ***************************
/*$member = $twilio->chat->v2->services("ISf3057fcd46c2488aa0a7882e464263a7")
                           ->channels("CHb399752bb36849f6bc6c03fd4e6b9563")
                           ->members
                           ->create("josea3712");
print($member->sid);*/
namespace Models{
class User
  {
    private $twilio;
    function __construct($twilio){
      $this->twilio = $twilio;
    }

    public function all_users()
    {
      $users = null;
      //old  ISf3057fcd46c2488aa0a7882e464263a7
      $users = $this->twilio->chat->v2->services("ISc4e910cc9a764ea1af2fa76666626be9")
                          ->users
                          ->read();
      return $users;

    }
    public function get_user_sid($identity)
    {
      $user = null;
      //ISf3057fcd46c2488aa0a7882e464263a7
      $user = $this->twilio->chat->v2->services("ISc4e910cc9a764ea1af2fa76666626be9")
                         ->users($identity)
                         ->fetch();
      return $user->sid;
    }

    public function get_user($identity){
      //ISf3057fcd46c2488aa0a7882e464263a7
      $user = $this->twilio->chat->v2->services("ISc4e910cc9a764ea1af2fa76666626be9")
                         ->users("$identity")
                         ->fetch();
      return $user;
    }

    public function create_user($identity)
    {
      //old// ISf3057fcd46c2488aa0a7882e464263a7
      //ISc4e910cc9a764ea1af2fa76666626be9
      $user = $this->twilio->chat->v2->services("ISc4e910cc9a764ea1af2fa76666626be9")
                         ->users
                         ->create($identity);
      return $user;

    }
    /*
    public function add_member_at_channel($channel_sid, $friendly_name)
    {
      $this->twilio->chat->v2->services("ISf3057fcd46c2488aa0a7882e464263a7")
                           ->channels($channel_sid)
                           ->members
                           ->create($friendly_name); 
    }*/
    public function add_member_at_channel($channel_sid, $identity)
    {
      //ISf3057fcd46c2488aa0a7882e464263a7
      $this->twilio->chat->v2->services("ISc4e910cc9a764ea1af2fa76666626be9")
                           ->channels($channel_sid)
                           ->members
                           ->create($identity); 
    }

    

  }
}