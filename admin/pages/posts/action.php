<?php
require_once "../../../config/connection.php";
include "../../../libraries/base_url.php";
require_once "../../../libraries/login_required.php";
require "../../../libraries/upload.php";

// untuk add post
if(isset($_POST['submit'])){

    // echo $username;
    // die;

    $sql_user = "SELECT * FROM users WHERE username=:username";
    
    $stmt_user = $koneksi->prepare($sql_user);
    $stmt_user->bindParam(':username', $_SESSION['username']);
    $stmt_user->execute();
  
    $user = $stmt_user->fetch();
  
    // filter data yang diinputkan
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $body = $_POST['body'];
    $category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_STRING);
    
    // $gambar = upload();
    echo $_FILES['gambar']['error'];
    move_uploaded_file($_FILES['gambar']['tmp_name'], 'upload/'.$_FILES['gambar']['name']);
    die;

  
    if($gambar){

      echo "gambar berhasil di upload";
      die;
      
      
      // menyiapkan query
      $sql = "INSERT INTO posts (category_id, image, title, body, user_id) VALUES (:category_id, :image, :title, :body, :user_id)";
      $stmt = $koneksi->prepare($sql);
    
      // bind parameter ke query
      $stmt->bindParam(":category_id", $category_id);
      $stmt->bindParam(":title", $title);
      $stmt->bindParam(":body", $body);
      $stmt->bindParam(":user_id", $user['user_id']);
      $stmt->bindParam(":image", $gambar);
    
    
      // eksekusi query untuk menyimpan ke database
      $saved = $stmt->execute();
    
    
      if($saved){
          header('Location: '. BASE_URL_ADMIN . 'pages/posts/?page=1');
      }
      else{
          echo "Edit Failed";
      }
    }
  
  
  
  }

// untuk edit post



// untukk hapus post