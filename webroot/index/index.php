<?php 
require_once '../connect/connect.php';
use Twilio\Rest\Client;
use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\ChatGrant;

    $identity = $_POST['identity'] ?? '';
    $signup = $_POST['signup'] ?? '';
    if(isset($_POST['btn_login']) && $identity != ''){
        //echo "Hola login";
        $users = $user_model->all_users();
        foreach ($users as $record) {
            //print($record->identity);
            if($record->identity == $identity)
            {//editar.php?id_categoria=" . $categoria['id_categoria']
                header("Location: ../chat/index.php?identity=" . $identity);
            }else{
                echo "Usuario no encontrado";
            }
        }
    }
    if(isset($_POST['btn_signup']) && $signup != ''){
        //echo "Hola signup";
         $users = $user_model->all_users();
         $repit = false;
         foreach ($users as $record) {
           if($record->identity == $signup)
           {
            $repit = true;
           }
        }
        if($repit == true)
        {
            echo "No se logró, el usuario se encuentra en uso";
        }
        else{
            $user_model->create_user($signup);
            header("Location: ../chat/index.php?identity=" . $signup);
        }
        
    }
 ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	
	<title>Welcome</title>
</head>
<body>
<form action="index.php" method="POST">
 <div style="display: flex; width: 40vw; height: 40vh; flex-wrap: wrap; position: absolute; top: 13%; left: 2%;">
    <label>Nickname: </label>
    <input type="text" name="identity" autofocus style="border-style: groove; margin-left: 3%; width: 225px; height:35px;" placeholder="My identity" value="<?= isset($_POST['id_categoria']) ? $_POST['id_categoria'] : ''; ?>">
    <button id="btn_login" value="" name="btn_login" class="btn btn-success" type="submit" style="margin-left: 3%; width: 100px; height:33px;">GO</button>
 </div>
 <div style="display: flex; width: 40vw; height: 40vh; flex-wrap: wrap; position: absolute; top: 60%; left: 2%;">
    <label>Nickname: </label>
    <input type="text" name="signup" autofocus style="border-style: groove; margin-left: 3%; width: 225px; height:35px;" placeholder="New Unique Nick" value="<?= isset($_POST['signup']) ? $_POST['signup'] : ''; ?>">
    <button id="btn_signup" value="" name="btn_signup" class="btn btn-primary" type="submit" style="margin-left: 3%; width: 100px; height:33px;">SIGN UP</button>
 </div> 
</form>
</body>
</html>


