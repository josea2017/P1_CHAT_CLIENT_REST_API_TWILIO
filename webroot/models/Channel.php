<?php

namespace Models{
class Channel
  {
    private $twilio;
    function __construct($twilio){
      $this->twilio = $twilio;
    }

    public function all_channels()
    {
      $channels = null;
      $channels = $this->twilio->chat->v2->services("ISf3057fcd46c2488aa0a7882e464263a7")
                             ->channels
                             ->read();
      return $channels;
    }
    public function delete_channel($sid)
    {
      $this->twilio->chat->v2->services("ISf3057fcd46c2488aa0a7882e464263a7")
                 ->channels($sid)
                 ->delete();
    }
    public function create_channel($new_channel_name)
    {
      $this->twilio->chat->v2->services("ISf3057fcd46c2488aa0a7882e464263a7")
                                ->channels
                                ->create(array("friendlyName" => $new_channel_name));
    }
    
    
    

  }
}