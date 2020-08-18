<?php

require_once "../../../config/connection.php";
include "../../../libraries/base_url.php";
require_once "../../../libraries/login_required.php";
require_once "../../../libraries/upload.php";

$post_id = $_GET['id'];
$sql_data = "SELECT * FROM posts WHERE post_id=:post_id";

$stmt_data = $koneksi->prepare($sql_data);
$stmt_data->bindParam(":post_id", $post_id);
$stmt_data->execute();

$data =$stmt_data->fetch();
// $category_id = $data['category_id'];

$sql_categories = "SELECT * FROM categories";

$stmt_categories = $koneksi->prepare($sql_categories);
$stmt_categories->execute();


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
            <h1>Post Edit</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">General</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>
              </div>
            </div>
            <div class="card-body">
              <form action="<?= BASE_URL_ADMIN ?>pages/posts/action.php" method="POST" enctype="multipart/form-data">
              <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
                <div class="form-group col-sm-4">
                    <label for="title">Title</label>
                    <input value="<?= $data['title'] ?>" type="text" class="form-control" id="category" name="title">
                </div>
                <div class="form-group col-sm-4">
                    <label for="gambar">Image</label>
                    <img src="<?= BASE_URL.'/img/'.$data['image'] ?>" height="50" alt="Tidak ada Gambar">
                    <input type="file" class="form-control" id="gambar" name="gambar">
                </div>
                <div class="form-group">
                    <label for="summernote">Body</label>
                    <textarea name="body" id="summernote"><?= $data['body'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select class="form-control col-sm-4" name="category_id" id="category">
                      <?php while($row = $stmt_categories->fetch()){ ?>
                        <?php if($row['category_id']==$data['category_id']): ?>
                          <option value="<?= $row['category_id'] ?>" selected><?= $row['category'] ?></option>
                        <?php else: ?>
                          <option value="<?= $row['category_id'] ?>"><?= $row['category'] ?></option>
                        <?php endif; ?>
                      <?php } ?>
                    </select>
                </div>
                <a href="#" class="btn btn-secondary">Cancel</a>
                <input name="edit" type="submit" value="Edit Post" class="btn btn-success">
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