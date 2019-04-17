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
      //ISf3057fcd46c2488aa0a7882e464263a7
      $channels = $this->twilio->chat->v2->services("ISc4e910cc9a764ea1af2fa76666626be9")
                             ->channels
                             ->read();
      return $channels;
    }
    public function delete_channel($sid)
    {
      //ISf3057fcd46c2488aa0a7882e464263a7
      $this->twilio->chat->v2->services("ISc4e910cc9a764ea1af2fa76666626be9")
                 ->channels($sid)
                 ->delete();
    }
    public function create_channel($new_channel_name)
    {
      //ISf3057fcd46c2488aa0a7882e464263a7
      $this->twilio->chat->v2->services("ISc4e910cc9a764ea1af2fa76666626be9")
                                ->channels
                                ->create(array("friendlyName" => $new_channel_name));
    }

    public function edit_channel($channel_id, $new_name)
    {
      //ISf3057fcd46c2488aa0a7882e464263a7
      $this->twilio->chat->v2->services("ISc4e910cc9a764ea1af2fa76666626be9")
                            ->channels($channel_id)
                            ->update(array(
                                         "friendlyName" => $new_name
                                     )
                            );
    }   
    
  }
}