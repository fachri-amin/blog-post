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


?>

<!doctype html>
<html lang="en">
  <head>
    <title>User List</title>
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
                        <a class="nav-link" href="<?= BASE_URL ?>pages/users/logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Created</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while($row = $stmt->fetch()){ ?>
                <tr>
                    <th scope="row"><?= $count ?></th>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['username'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['created_at'] ?></td>
                    <td>
                        <a href="<?= BASE_URL .'pages/users/manage/user_edit.php?id='.$row['user_id'] ?>" class="btn btn-warning">Edit</a>
                        <a onClick="javascript: return confirm('Please confirm deletion');" href="<?= BASE_URL .'pages/users/manage/user_delete.php?id='.$row['user_id'] ?>" class="btn btn-danger">Delete</a>
                    </td>
                    <?php $count++ ?>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <?php for($i=1; $i <= $total_page; $i++){ ?>
                <li class="page-item">
                    <a class="page-link" href="<?= BASE_URL ?>pages/users/manage/user_list.php?page=<?= $i ?>"><?= $i ?></a>
                </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>