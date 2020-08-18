<?php

require_once "../../../config/connection.php";
include "../../../libraries/base_url.php";


if(isset($_POST['login'])){

    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM users WHERE username=:username";
    $stmt = $koneksi->prepare($sql);
    
    // bind parameter ke query
    $stmt->bindParam(":username", $username);
    // $stmt->bindParam(":password", $password);

    $stmt->execute();

    $user = $stmt->fetch();
    
    if($user){
        // verifikasi password
        if(password_verify($password, $user["password"])){
            // buat Session
            session_start();
            $_SESSION["username"] = $user['username'];
            // login sukses, alihkan ke halaman timeline
            header("Location:".BASE_URL);
        }
        else{
            header('Location:'.BASE_URL_ADMIN.'login.php');
        }
    }
    else{
        $login_page = BASE_URL_ADMIN.'login.php';
        header('Location:'.BASE_URL_ADMIN.'login.php');
    }
}

?>