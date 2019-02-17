<?php

if (!isset($_SESSION['identity']) || empty($_SESSION['identity'])) {
  	header("Location: ../index/index.php");
  
}