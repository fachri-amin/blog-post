<?php

require_once "../../../config/connection.php";
include "../../../libraries/base_url.php";
require_once "../../../libraries/login_required.php";

$category_id = $_GET['id'];
$sql_data = "SELECT * FROM categories WHERE category_id = :category_id";

$stmt_data = $koneksi->prepare($sql_data);
$stmt_data->bindParam(":category_id", $category_id);
$stmt_data->execute();

$data = $stmt_data->fetch();

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
              <li class="breadcrumb-item active">Category Edit</li>
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
                    <label for="category">Category</label>
                    <input value="<?= $data['category'] ?>" type="text" class="form-control" id="category" name="category">
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