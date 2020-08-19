<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= BASE_URL_ADMIN ?>" class="brand-link">
      <img src="<?= BASE_URL_ADMIN; ?>/assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Blog Post</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?= BASE_URL_ADMIN; ?>/assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $username ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Manage
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?= BASE_URL_ADMIN ?>pages/users/" class="nav-link">
                  <i class="fas fa-users nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= BASE_URL_ADMIN ?>pages/posts/" class="nav-link">
                  <i class="far fa-newspaper nav-icon"></i>
                  <p>Posts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= BASE_URL_ADMIN ?>pages/categories/" class="nav-link">
                  <i class="fas fa-sitemap nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
          </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="" data-toggle="modal" data-target="#modal-default" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
              <p class="text">Log Out</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Modal -->
  <!-- Modal for logout -->
  <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Log Out Confirmation</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure to logout?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <a href="<?= BASE_URL_ADMIN ?>pages/users/logout.php" class="btn btn-primary">Yes</a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>