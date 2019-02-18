<?php
require_once '../../vendor/autoload.php';
require_once '../connect/connect.php';
require_once '../seguridad/sessions.php';
$channel_id = $_GET["channel_id"] ?? '';
//echo $_SESSION['identity'];
//echo $channel_id;
if(isset($_POST['btn_new_channel_name'])){
   $new_name = $_POST['input_new_channel_name'];
   $channel_model->edit_channel($channel_id, $new_name);
   header("Location: /P1_CHAT_CLIENT_REST_API_TWILIO/webroot/chat/index.php?identity=" . $_SESSION['identity']);
    //header("Location: ../chat/index.php?identity=" . $identity);
}
if(isset($_POST['btn_cancel'])){
   header("Location: /P1_CHAT_CLIENT_REST_API_TWILIO/webroot/chat/index.php?identity=" . $_SESSION['identity']);
}
?>
<!DOCTYPE html>
<html>
<head>
    <!--<meta http-equiv="refresh" content="5" > -->
    <title>Local chat</title>
    <link rel="shortcut icon" href="//www.twilio.com/marketing/bundles/marketing/img/favicons/favicon.ico">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="index.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
  <form method="POST">
	<div style="display: flex; position: absolute; width: 30%; margin-top: 10%; margin-left: 30%;">
      <table class="table table-hover text-center" style="text-align: center; margin-top: 0%;" border="1">
        <thead class="table_head">
          <tr>
              <th colspan="2" style="color:black;">EDIT CHANNEL</th>
          </tr>
        </thead>
       <tbody>
         <tr>
           <td><label style="color:black;">New name: </label></td>
           <td><input type="text" placeholder="New channel name" id="input_new_channel_name" name="input_new_channel_name" value="<?='';?>">
           </td>
         </tr>
         <tr> 
           <td colspan="2"> <button class="btn btn-success" type="submit" name="btn_new_channel_name" style="width: 250px;">Edit</button></td>
         </tr>
         <tr> 
           <td colspan="2"> <button class="btn btn-danger" type="submit" name="btn_cancel" style="width: 250px;">Cancel</button></td>
         </tr>
       </tbody>
     </table>
    </div>
  </form>
</body>

  <script src="https://media.twiliocdn.com/sdk/js/common/v0.1/twilio-common.min.js"></script>
  <script src="https://media.twiliocdn.com/sdk/js/chat/v3.0/twilio-chat.min.js"></script>
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="index.js"></script>
</body>
</html>