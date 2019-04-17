<?php

namespace Models{
class Message
  {
    private $twilio;
    function __construct($twilio){
      $this->twilio = $twilio;
    }

    public function get_messages_user_in_channel($channel_id)
    {
      $messages = null;
      //ISf3057fcd46c2488aa0a7882e464263a7
      $messages = $this->twilio->chat->v2->services("ISc4e910cc9a764ea1af2fa76666626be9")
                             ->channels($channel_id)
                             ->messages
                             ->read();
      return $messages;
    }

    public function create_message($channel_id, $message)
    {
      //ISf3057fcd46c2488aa0a7882e464263a7
      $this->twilio->chat->v2->services("ISc4e910cc9a764ea1af2fa76666626be9")
                            ->channels($channel_id)
                            ->messages
                            ->create(array("body" => $message));
    }

    
      
    }
}