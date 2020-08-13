<?php

require_once "../../../config/connection.php";
include "../../../libraries/base_url.php";
require_once "../../../libraries/login_required.php";


if(isset($_GET['search'])){

  $search_exact = $_GET['search'];

  $search = '%'.$search_exact.'%';

  $halaman = 2;
  $page = isset($_GET['page'])? (int)$_GET["page"]:1;
  $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
  
  
  $sql = "SELECT * FROM users WHERE name LIKE :search OR username LIKE :search OR email LIKE :search LIMIT $mulai, $halaman";
  $stmt = $koneksi->prepare($sql);

  $stmt->bindParam(':search', $search);  
  
  $stmt->execute();
  
  // menghitung semua data
  
  $sql2 = "SELECT * FROM users WHERE name LIKE :search OR username LIKE :search OR email LIKE :search";
  
  $stmt2 = $koneksi->prepare($sql2);
  $stmt2->bindParam(':search', $search);  
  $stmt2->execute();
  $total = $stmt2->rowCount();
  
  $total_page = ceil($total/$halaman);
  
  $count = 1;
}
else{
  $halaman = 2;
  $page = isset($_GET['page'])? (int)$_GET["page"]:1;
  $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
  
  
  $sql = "SELECT * FROM users LIMIT $mulai, $halaman";
  $stmt = $koneksi->prepare($sql);
  
  
  $stmt->execute();
  
  // menghitung semua data
  
  $sql2 = "SELECT * FROM users";
  
  $stmt2 = $koneksi->prepare($sql2);
  $stmt2->execute();
  $total = $stmt2->rowCount();
  
  $total_page = ceil($total/$halaman);
  
  $count = 1;
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
            <h1>Users Management</h1>
          </div>
          <div class="col-sm-6">
            <form class="form-inline float-right" action="" method="get">
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
                          Username
                      </th>
                      <th style="width: 30%">
                          E-mail
                      </th>
                      <th>
                          Name
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
                          <a>
                              <?= $row['username'] ?>
                          </a>
                          <br/>
                          <small>
                              <?= $row['created_at'] ?>
                          </small>
                      </td>
                      <td>
                          <?= $row['email'] ?>
                      </td>
                      <td>
                        <?= $row['name'] ?>
                      </td>
                      <td class="project-actions text-left">
                          <a class="btn btn-info btn-sm" href="<?= BASE_URL_ADMIN.'pages/users/user_edit.php?id='.$row['user_id'] ?>">
                              <i class="fas fa-pencil-alt">
                              </i>
                              Edit
                          </a>
                          <a onClick="javascript: return confirm('Please confirm deletion');" class="btn btn-danger btn-sm" href="<?= BASE_URL_ADMIN ?>pages/users/user_delete.php?id=<?= $row['user_id'] ?>">
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
        <div class="float-right mr-5">
          <a href="" class="btn btn-primary">Add new</a>
        </div>
        <ul class="pagination">
            <?php for($i=1; $i <= $total_page; $i++){ ?>
              <?php if(isset($_GET['search'])): ?>
                <li class="page-item">
                    <a class="page-link" href="<?= BASE_URL_ADMIN ?>pages/users/?page=<?= $i.'&search='.$_GET['search'] ?>"><?= $i ?></a>
                </li>
              <?php else: ?>
                <li class="page-item">
                    <a class="page-link" href="<?= BASE_URL_ADMIN ?>pages/users/?page=<?= $i ?>"><?= $i ?></a>
                </li>
              <?php endif; ?>
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