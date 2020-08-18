<?php

require_once "config/connection.php";
include "libraries/base_url.php";

session_start();

$sql_categories = "SELECT * FROM categories";
$stmt_categories = $koneksi->prepare($sql_categories);
$stmt_categories->execute();

if($_GET['id']){
    $post_id = $_GET['id'];
    $sql = "SELECT * FROM posts INNER JOIN users USING (user_id) INNER JOIN categories USING (category_id) WHERE post_id=$post_id";
    $stmt = $koneksi->prepare($sql);
    $stmt->execute();
    $post = $stmt->fetch();
}


//HTML start here
include "base_template/home/header.php";
?>

<!-- Title -->
<h1 class="mt-4"><?= $post['title'] ?></h1>

<!-- Author -->
<p class="lead">
    by
    <a href="#"><?= $post['name'] ?></a>
</p>

<hr>

<!-- Date/Time -->
<p>Posted on <?= $post['created_at'] ?></p>

<hr>

<!-- Preview Image -->
<?php if($post['image']): ?>
    <img class="card-img-top" src="<?= BASE_URL.'/img/'.$post['image'] ?>" alt="Card image cap">
<?php else: ?>
    <img class="img-fluid rounded" src="http://placehold.it/900x300" alt="">
<?php endif; ?>

<hr>

<!-- Post Content -->
<p><?= $post['body'] ?></p>

<hr>
<?php 

include "base_template/home/sidebar.php";
include "base_template/home/footer.php";

?>