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
      $messages = $this->twilio->chat->v2->services("ISf3057fcd46c2488aa0a7882e464263a7")
                             ->channels($channel_id)
                             ->messages
                             ->read();
      return $messages;
    }

    public function create_message($channel_id, $message)
    {
      $this->twilio->chat->v2->services("ISf3057fcd46c2488aa0a7882e464263a7")
                            ->channels($channel_id)
                            ->messages
                            ->create(array("body" => $message));
    }

    
      
    }
}