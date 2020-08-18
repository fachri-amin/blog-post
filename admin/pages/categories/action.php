<?php

require_once "../../../config/connection.php";
include "../../../libraries/base_url.php";
require_once "../../../libraries/login_required.php";
require "../../../libraries/upload.php";


//create category
if(isset($_POST['submit'])){

    // filter data yang diinputkan
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);

    // menyiapkan query
    $sql = "INSERT INTO categories (category) VALUES (:category)";
    $stmt = $koneksi->prepare($sql);

    // bind parameter ke query
    $stmt->bindParam(":category", $category);

    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute();

    if($saved){
        header('Location: '. BASE_URL_ADMIN . 'pages/categories/?page=1');
    }
    else{
        echo "Edit Failed";
    }

}


//edit category
if(isset($_POST['edit'])){

    // filter data yang diinputkan
    $category = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING);

    // menyiapkan query
    $sql = "UPDATE categories SET category=:category WHERE category_id=:category_id";
    $stmt = $koneksi->prepare($sql);

    // bind parameter ke query
    $stmt->bindParam(":category", $category);
    $stmt->bindParam(":category_id", $category_id);
    
    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute();

    if($saved){
        header('Location: '. BASE_URL_ADMIN . 'pages/categories/?page=1');
    }
    else{
        echo "Edit Failed";
    }

}

?>