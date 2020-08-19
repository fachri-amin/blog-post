<?php

require_once "../../../config/connection.php";
require_once "../../../libraries/base_url.php";
require_once "../../../libraries/login_required.php";

$dir = BASE_URL_ADMIN.'pages/users/';

$user_id = $_GET['id'];

if($user_id==$_SESSION['user_id']){
    echo "<script>
        alert('You can not delete yourself');
        window.location.href = '$dir';
    </script>";

    exit;
    
}
else{
    $sql="DELETE FROM users WHERE user_id = :user_id";
    $stmt = $koneksi->prepare($sql);
    $stmt->bindParam(":user_id", $user_id);
    $stmt->execute();
    
    header('Location:'.BASE_URL_ADMIN.'pages/users/?page=1');
}


?>