<?php

require_once "../config/connection.php";
include "../libraries/base_url.php";

session_start();
if(!isset($_SESSION['username'])){
  header('location:'. BASE_URL . 'pages/users/login.php');
}
else{
  $username = $_SESSION['username'];
}

include "includes/header.php";

include "includes/navbar.php";

include "includes/sidebar.php";

?>


    <div class="content-wrapper">
        <h1>INI CONTENT</h1>
    </div>


<?php
    include "includes/footer.php";
?>