<?php

require_once "../../../config/connection.php";
include "../../../libraries/base_url.php";
require_once "../../../libraries/login_required.php";


$halaman = 2;
$page = isset($_GET['page'])? (int)$_GET["page"]:1;
$mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;


$sql = "SELECT * FROM categories LIMIT $mulai, $halaman";
$stmt = $koneksi->prepare($sql);


$stmt->execute();

// menghitung semua data

$sql2 = "SELECT * FROM categories";

$stmt2 = $koneksi->prepare($sql2);
$stmt2->execute();
$total = $stmt2->rowCount();

$total_page = ceil($total/$halaman);

$count = 1;


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
            <h1>Users Management</h1>
          </div>
          <div class="col-sm-6">
            <form class="form-inline float-right" action="<?= BASE_URL_ADMIN ?>pages/users/user_search.php" method="get">
              <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search by username" aria-label="Search">
              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
          </div>
        </div>
      </div><!-- /.container-fluid -->
      <!-- SEARCH FORM -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Users</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fas fa-times"></i></button>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%">
                          #
                      </th>
                      <th style="width: 20%">
                          Category
                      </th>
                      <th style="width: 30%">
                          Created at
                      </th>
                      <th style="width: 20%">
                        Action
                      </th>
                  </tr>
              </thead>
              <tbody>
              <?php while($row = $stmt->fetch()){ ?>
                  <tr>
                      <td>
                          <?= $count ?>
                      </td>
                      <td>
                          <?= $row['category'] ?>
                      </td>
                      <td>
                        <?= $row['created_at'] ?>
                      </td>
                      <td class="project-actions text-left">
                          <a class="btn btn-info btn-sm" href="<?= BASE_URL_ADMIN.'pages/categories/category_edit.php?id='.$row['category_id'] ?>"">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          <a onClick="javascript: return confirm('Please confirm deletion');" class="btn btn-danger btn-sm" href="<?= BASE_URL_ADMIN ?>pages/categories/category_delete.php?id=<?= $row['category_id'] ?>">
                              <i class="fas fa-trash">
                              </i>
                              Delete
                          </a>
                      </td>
                  </tr>
              <?php $count++; } ?>
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
    </div>
    <nav aria-label="Page navigation example">
        <div class="float-right">
          <a href="<?= BASE_URL_ADMIN.'pages/categories/category_create.php' ?>" class="btn btn-primary">Add new</a>
        </div>
        <ul class="pagination">
            <?php for($i=1; $i <= $total_page; $i++){ ?>
            <li class="page-item">
                <a class="page-link" href="<?= BASE_URL_ADMIN ?>pages/categories/?page=<?= $i ?>"><?= $i ?></a>
            </li>
            <?php } ?>
        </ul>
    </nav>
      <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
  <!-- /.content-wrapper -->

<?php
    include "../../includes/footer.php";
?>