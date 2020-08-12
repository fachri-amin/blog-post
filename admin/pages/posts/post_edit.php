<?php

require_once "../../../config/connection.php";
include "../../../libraries/base_url.php";
require_once "../../../libraries/login_required.php";

$post_id = $_GET['id'];
$sql_data = "SELECT * FROM posts WHERE post_id=:post_id";

$stmt_data = $koneksi->prepare($sql_data);
$stmt_data->bindParam(":post_id", $post_id);
$stmt_data->execute();

$data =$stmt_data->fetch();


if(isset($_POST['submit'])){

  $sql_user = "SELECT * FROM users WHERE username=:username";
  
  $stmt_user = $koneksi->prepare($sql_user);
  $stmt_user->bindParam(':username', $_SESSION['username']);
  $stmt_user->execute();

  $user = $stmt_user->fetch();

  // filter data yang diinputkan
  $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
  $body = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_STRING);
  $category_id = filter_input(INPUT_POST, 'category_id', FILTER_SANITIZE_STRING);

  // menyiapkan query
  $sql = "UPDATE posts SET category_id=:category_id, title=:title, body=:body WHERE post_id=:post_id";
  $stmt = $koneksi->prepare($sql);

  // bind parameter ke query
  $stmt->bindParam(":category_id", $category_id);
  $stmt->bindParam(":title", $title);
  $stmt->bindParam(":body", $body);
  
  // eksekusi query untuk menyimpan ke database
  $saved = $stmt->execute();

  $sql_categories = "SELECT * FROM categories";

  $stmt_categories = $koneksi->prepare($sql_categories);
  $stmt_categories->execute();

  $categories = $stmt_categories->fetch();

  if($saved){
      header('Location: '. BASE_URL_ADMIN . 'pages/posts/?page=1');
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
            <h1>Post Add</h1>
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
                    <label for="title">Title</label>
                    <input value="<?= $data['title'] ?>" type="text" class="form-control" id="category" name="category">
                </div>
                <div class="form-group">
                    <label for="body">Body</label>
                    <textarea name="body" id="body" class="form-control" cols="30" rows="10"><?= $data['body'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select name="category_id" id="catgeory">
                      <?php while($row = $categories){ ?>
                        <option value="<?= $row['category_id'] ?>" <?php if($row['category_id']==$data['category_id']){echo "selected";}?>><?= $row['category'] ?></option>
                      <?php } ?>
                    </select>
                </div>
                <a href="#" class="btn btn-secondary">Cancel</a>
                <input name="submit" type="submit" value="Add Post" class="btn btn-success">
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