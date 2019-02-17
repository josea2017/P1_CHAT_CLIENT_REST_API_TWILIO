<?php
  require_once 'sessions.php';
  session_destroy();
  header("Location: ../index/index.php");
?>