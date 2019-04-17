<?php
require_once '../models/User.php';
require_once '../models/Channel.php';
require_once '../models/UserChannel.php';
require_once '../models/Message.php';
require_once '../../vendor/autoload.php';
use Twilio\Rest\Client;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\ChatGrant;
//old $sid    = "AC68e755f9b09bf542c5ae71b4cc2302dd";
//old $token  = "dc81fac28291f97f176f6dec305b5fc9";
$sid    = "ACa73f2c3ad068b4f755f7df86ac799a8d";
$token  = "fb23dae9ffe3fb4d7cda20d96af203a6";
$twilio = new Client($sid, $token);


$user_model = new Models\User($twilio);
$channel_model = new Models\Channel($twilio);
$user_channels_model = new Models\UserChannel($twilio);
$message_model = new Models\Message($twilio);



