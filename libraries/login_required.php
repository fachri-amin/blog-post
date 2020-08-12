<?php

session_start();
if(!isset($_SESSION['username'])){
  header('location:'. BASE_URL_ADMIN . 'pages/users/login.php');
}
else{
  $username = $_SESSION['username'];
}

?>