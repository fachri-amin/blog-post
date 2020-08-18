<?php

require_once "../../../config/connection.php";
include "../../../libraries/base_url.php";
require_once "../../../libraries/login_required.php";
require "../../../libraries/upload.php";


//register user
if(isset($_POST['register'])){

    // filter data yang diinputkan
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);


    // menyiapkan query
    $sql = "INSERT INTO users (name, username, email, password, active) 
            VALUES (:name, :username, :email, :password, 1)";
    $stmt = $koneksi->prepare($sql);

    // bind parameter ke query
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $password);
    $stmt->bindParam(":email", $email);
    
    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute();

    if($saved){
        header('Location: '. BASE_URL_ADMIN . 'login.php');
    }
    else{
        echo "Register Failed";
    }
}

//edit user
if(isset($_POST['edit'])){

    // filter data yang diinputkan
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);


    // menyiapkan query
    $sql = "UPDATE users SET name=:name, username=:username, email=:email, password=:password WHERE user_id=:user_id";
    $stmt = $koneksi->prepare($sql);

    // bind parameter ke query
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":username", $username);
    $stmt->bindParam(":password", $password);
    $stmt->bindParam(":email", $email);
    $stmt->bindParam(":user_id", $user_id);
    
    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute();

    if($saved){
        header('Location: '. BASE_URL_ADMIN . 'pages/users/?page=1');
    }
    else{
        echo "Edit Failed";
    }

}

?>