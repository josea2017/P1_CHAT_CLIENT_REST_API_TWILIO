<?php

namespace Models{
class UserChannel
  {
    private $twilio;
    function __construct($twilio){
      $this->twilio = $twilio;
    }

    public function channels_list_per_user($sid)
    {
      //ISf3057fcd46c2488aa0a7882e464263a7
      $userChannels = $this->twilio->chat->v2->services("ISc4e910cc9a764ea1af2fa76666626be9")
                                 ->users($sid)
                                 ->userChannels
                                 ->read();
      return $userChannels;
     }
      
    }
}