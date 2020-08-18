<?php

require_once "../../../config/connection.php";
include "../../../libraries/base_url.php";
require_once "../../../libraries/login_required.php";


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
            <h1>Category Add</h1>
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
              <form action="<?= BASE_URL_ADMIN ?>pages/categories/action.php" method="POST">
                <div class="form-group">
                    <label for="category">Category</label>
                    <input type="text" class="form-control" id="category" name="category">
                </div>
                <a href="#" class="btn btn-secondary">Cancel</a>
                <input name="submit" type="submit" value="Add Category" class="btn btn-success">
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