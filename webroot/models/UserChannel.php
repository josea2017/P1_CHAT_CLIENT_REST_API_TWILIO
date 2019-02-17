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
      $userChannels = $this->twilio->chat->v2->services("ISf3057fcd46c2488aa0a7882e464263a7")
                                 ->users($sid)
                                 ->userChannels
                                 ->read();
      return $userChannels;
     }
      
    }
}