<?php

require_once "../../../config/connection.php";
include "../../../libraries/base_url.php";

session_start();
if(!isset($_SESSION['username'])){
  header('location:'. BASE_URL . 'pages/users/login.php');
}
else{
  $username = $_SESSION['username'];
}

$user_id = $_GET['id'];
$sql_data = "SELECT * FROM users WHERE user_id = :user_id";

$stmt_data = $koneksi->prepare($sql_data);
$stmt_data->bindParam(":user_id", $user_id);
$stmt_data->execute();

$data = $stmt_data->fetch();

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

// HTML Start here

include "../../includes/header.php";

include "../../includes/navbar.php";

include "../../includes/sidebar.php";

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project Add</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Project Add</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
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
                <a href="#" class="btn btn-secondary">Cancel</a>
                <input name="edit" type="submit" value="Edit" class="btn btn-success">
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
    include "../../includes/footer.php";
?>