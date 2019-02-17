<?php
// Update the path below to your autoload.php,
// see https://getcomposer.org/doc/01-basic-usage.md
require_once '../../vendor/autoload.php';
require_once '../connect/connect.php';
require_once '../seguridad/sessions.php';
$identity = $_GET["identity"] ?? '';
$user_sid = $user_model->get_user_sid($identity);
$_SESSION['identity'] = $identity;
require_once '../seguridad/sessions_verify.php';
//echo $_SESSION['identity'];
use Twilio\Rest\Client;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\ChatGrant;
// Find your Account Sid and Auth Token at twilio.com/console
$sid    = "AC68e755f9b09bf542c5ae71b4cc2302dd";
$token  = "dc81fac28291f97f176f6dec305b5fc9";
$twilio = new Client($sid, $token);
/////////***************    CHANNELS   **********************************
if(isset($_POST['btn_delete_channel'])){
    $channel_model->delete_channel($_POST['btn_delete_channel']);
}
$new_channel_name = $_POST['input_new_channel'] ?? '';
if(isset($_POST['btn_new_channel'])){
    $channel_model->create_channel($new_channel_name);
}
//////////***********   USER CHANNELS  **********************
//traer todos los canales en los que un usuario esta inscrito
////////////////////////************   MESSAGES  *********************
$messages = null;
$selected_idchannel = null;
$chat_input = null;
$chat_input = $_POST['chat_input'];
if(isset($_POST['btn_create_message'])){
   echo $chat_input;
   $selected_idchannel = $_POST['btn_create_message'];
   echo $selected_idchannel;
   $message_model->create_message($selected_idchannel, $chat_input);
   $messages = $message_model->get_messages_user_in_channel($selected_idchannel);
}
if(isset($_POST['btn_view_channel'])){
    $user_channels = null;
    $user_channels = $user_channels_model->channels_list_per_user($user_sid);
    foreach ($user_channels as $record) {
      if($record->channelSid == $_POST['btn_view_channel']){
        $selected_idchannel = $_POST['btn_view_channel'];
        $messages = $message_model->get_messages_user_in_channel($_POST['btn_view_channel']);
      }
    }
}
//echo $selected_idchannel;



/*$messages = $twilio->chat->v2->services("ISf3057fcd46c2488aa0a7882e464263a7")
                             ->channels("CHb399752bb36849f6bc6c03fd4e6b9563")
                             ->messages
                             ->read();*/
/*foreach ($messages as $record) {
    print($record->body);
}*/
///////// **********************  USER  ***************
if(isset($_POST['btn_join_at_channel'])){
   $user_model->add_member_at_channel($_POST['btn_join_at_channel'], $identity);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Twilio Chat Quickstart</title>
    <link rel="shortcut icon" href="//www.twilio.com/marketing/bundles/marketing/img/favicons/favicon.ico">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>
<body>
  <form method="POST">
    <div style="display: flex; position: absolute; width: 20%; margin-top: 1%;">
      <table class="table table-hover text-center" style="text-align: center; margin-top: 0%;" border="1">
        <thead class="table_head">
           <tr>
              <th colspan="2"><a class='btn btn-danger' style="width: 250px;" href='../seguridad/logout.php'>Loguot</a></th>
          </tr>
          <tr>
              <th colspan="2" style="color:white;">NEW CHANNEL</th>
          </tr>
        </thead>
       <tbody>
         <tr>
           <td><label style="color:white;">Name: </label></td>
           <td><input type="text" placeholder="Channel name" id="input_new_channel" name="input_new_channel" value="<?='';?>">
           </td>
         </tr>
         <tr>
           <td colspan="2"> <button class="btn btn-success" type="submit" name="btn_new_channel" style="width: 250px;">Create</button></td>
         </tr>
       </tbody>
     </table>
    </div>
    <div style="display: flex; position: absolute; width: 20%; margin-top: 18%;">
     <table class="table table-hover text-center" style="text-align: center; margin-top: 0%;" border="1">
        <thead class="table_head">
          <tr>
              <th colspan="2" style="color: white">CHANNELS LIST</th>
            </tr>
        </thead>
        <?php 
        //echo "<td>" . "<a class='btn btn-primary'>" . $record->friendlyName . "</a>" . "</td>";
          $channels = null;
          $channels = $channel_model->all_channels();
          if($channels != null)
          {
          foreach ($channels as $record) {
            echo "<tr>";
            echo "<td>" . "<button class='btn btn-primary' type='submit' name='btn_view_channel' value='$record->sid'>" .  $record->friendlyName . "</button>" . 
                 "</td>";
            echo "<td>" . "<button class='btn btn-warning' type='submit' name='btn_join_at_channel' value='$record->sid'>" .  "Join" . "</button>" . 
                 "</td>";
            echo "<td>" .
                         "<button class='btn btn-danger' type='submit' name='btn_delete_channel' value='$record->sid'>" .  "Eliminar" . "</button>" .
                  "</td>";                      
            echo "</tr>";
           } 
         }
         ?>
     </table>
    </div>
  </form>
  <form method="POST">
    <section>
      <div id="messages">
        <?php 
            foreach ($messages as $record) {
              echo "<p style='color:white;'>" . $record->body . "</p>";
            }
         ?>
      </div>
     
    </section>
    <div style="display: flex; position: absolute; width: 40%; height: 10%; margin-top: 1%; margin-left: 25%;">
        <input id="chat-input" name="chat_input" type="text" style="color:black; width: 100%;" placeholder="say anything" autofocus value="<?= isset($_POST['chat_input']) ? $_POST['chat_input'] : ''; ?>" />
        <?php  
         echo "<button class='btn btn-secondary' type='submit' name='btn_create_message' value='$selected_idchannel'>" .  "Send" . "</button>";
         ?>
    </div>
  </form>

  <script src="https://media.twiliocdn.com/sdk/js/common/v0.1/twilio-common.min.js"></script>
  <script src="https://media.twiliocdn.com/sdk/js/chat/v3.0/twilio-chat.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="index.js"></script>
</body>
</html>




