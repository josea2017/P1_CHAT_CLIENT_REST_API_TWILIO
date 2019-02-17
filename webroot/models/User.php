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
      $users = $this->twilio->chat->v2->services("ISf3057fcd46c2488aa0a7882e464263a7")
                          ->users
                          ->read();
      return $users;

    }
    public function get_user_sid($identity)
    {
      $user = null;
      $user = $this->twilio->chat->v2->services("ISf3057fcd46c2488aa0a7882e464263a7")
                         ->users($identity)
                         ->fetch();
      return $user->sid;
    }

    public function create_user($identity)
    {
      $user = $this->twilio->chat->v2->services("ISf3057fcd46c2488aa0a7882e464263a7")
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
      $this->twilio->chat->v2->services("ISf3057fcd46c2488aa0a7882e464263a7")
                           ->channels($channel_sid)
                           ->members
                           ->create($identity); 
    }

    

  }
}