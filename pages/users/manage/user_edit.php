<?php

require_once "../../../config/connection.php";
require_once "../../../libraries/base_url.php";


$user_id = $_GET['id'];
$sql_data = "SELECT * FROM users WHERE user_id = :user_id";

$stmt_data = $koneksi->prepare($sql_data);
$stmt_data->bindParam(":user_id", $user_id);
$stmt_data->execute();

$data = $stmt_data->fetch();

if(isset($_POST['register'])){

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
        header('Location: '. BASE_URL . 'pages/users/manage/user_list.php?page=1');
    }
    else{
        echo "Edit Failed";
    }

}

?>

<!doctype html>
<html lang="en">
  <head>
    <title>User Registration</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="<?= BASE_URL ?>">Blog Post</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= BASE_URL ?>pages/users/login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="col-md-6">
            <h2>New User Registration</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input value="<?= $data['username'] ?>" type="text" class="form-control" id="username" name="username">
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input value="<?= $data['email'] ?>" type="email" class="form-control" id="email" name="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input value="<?= $data['password'] ?>" type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group">
                    <label for="name">Full name</label>
                    <input value="<?= $data['name'] ?>" type="text" class="form-control" id="name" name="name">
                </div>
                <input type="submit" class="btn btn-primary" name="register" value="Edit">
            </form>
        </div>
    </div>
      
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>