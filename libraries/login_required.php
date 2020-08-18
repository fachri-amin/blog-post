<?php

session_start();
if(!isset($_SESSION['username'])){
  header('location:'. BASE_URL_ADMIN . 'login.php');
}
else{
  $username = $_SESSION['username'];
}

?>