<?php

require_once "../config/connection.php";
include "../libraries/base_url.php";

session_start();
if(!isset($_SESSION['username'])){
  header('location:'. BASE_URL_ADMIN. 'pages/users/login.php');
}
else{
  $username = $_SESSION['username'];
}

// get total user
$sql_user = "SELECT * FROM users";

$stmt_user = $koneksi->prepare($sql_user);
$stmt_user->execute();

$total_user = $stmt_user->rowCount();

// get total post
$sql_post = "SELECT * FROM posts";

$stmt_post = $koneksi->prepare($sql_post);
$stmt_post->execute();

$total_post = $stmt_post->rowCount();

// get total categories
$sql_category = "SELECT * FROM categories";

$stmt_category = $koneksi->prepare($sql_category);
$stmt_category->execute();

$total_category = $stmt_category->rowCount();

// HTML start here

include "includes/header.php";

include "includes/navbar.php";

include "includes/sidebar.php";

?>


    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Admin's Dashboard</h1>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <section class="content">
        <div class="row">
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $total_user ?></h3>
  
                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?= BASE_URL_ADMIN ?>pages/users/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $total_post ?></h3>
  
                <p>Post Created</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?= BASE_URL_ADMIN ?>pages/posts/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3><?= $total_category ?></h3>
  
                <p>Categories Created</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?= BASE_URL_ADMIN ?>pages/categories/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <?php chdir('../');?>

          <h1><?= getcwd();?></h1>
          <!-- ./col -->
      </section>
    </div>


<?php
    include "includes/footer.php";
?>