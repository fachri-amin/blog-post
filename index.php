<?php

require_once "config/connection.php";
include "libraries/base_url.php";

session_start();

$sql_categories = "SELECT * FROM categories";
$stmt_categories = $koneksi->prepare($sql_categories);
$stmt_categories->execute();


$post_per_page = 5;
$page = isset($_GET['page'])? (int)$_GET['page']:1;
$start = ($page>1) ? ($page * $post_per_page) - $post_per_page: 0;

if(!isset($_GET['category'])){
    $sql_post = "SELECT * FROM posts INNER JOIN users USING (user_id) INNER JOIN categories USING (category_id) ORDER BY post_id DESC LIMIT $start, $post_per_page";
    $stmt_post = $koneksi->prepare($sql_post);
    $stmt_post->execute();


    //pagination
    $sql = "SELECT * FROM posts";
    $stmt = $koneksi->prepare($sql);
    $stmt->execute();
    $total = $stmt->rowCount();
      
    $total_page = ceil($total/$post_per_page);
}
else{
    $category = $_GET['category'];
    $sql_post = "SELECT * FROM posts INNER JOIN users USING (user_id) INNER JOIN categories USING (category_id) WHERE posts.category_id=:category_id ORDER BY post_id DESC LIMIT $start, $post_per_page";
    $stmt_post = $koneksi->prepare($sql_post);
    $stmt_post->bindParam(':category_id', $category);
    $stmt_post->execute();


    //pagination
    $sql = "SELECT * FROM posts WHERE category_id=:category_id";
    $stmt = $koneksi->prepare($sql);
    $stmt->bindParam(':category_id', $category);
    $stmt->execute();
    $total = $stmt->rowCount();
      
    $total_page = ceil($total/$post_per_page);
}




//menghitung semua data untuk pagination
// $sql = "SELECT * FROM posts";
// $stmt = $koneksi->prepare($sql);
// $stmt->execute();



//HTML start here
include "base_template/home/header.php";
?>

<h1 class="my-4">Blog Post</h1>

<?php while($post = $stmt_post->fetch()): ?>

<!-- Blog Post -->
<div class="card mb-4">
    <?php if($post['image']): ?>
        <img class="card-img-top" src="<?= BASE_URL.'/img/'.$post['image'] ?>" alt="Card image cap">
    <?php else: ?>
        <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
    <?php endif; ?>
    <div class="card-body">
    <h2 class="card-title"><?= $post['title'] ?></h2>
    <p class="card-text"><?= strip_tags(substr($post['body'], 0, 300)) ?></p>
    <a href="<?= BASE_URL.'post_detail.php?id='.$post['post_id'] ?>" class="btn btn-primary">Read More &rarr;</a>
    </div>
    <div class="card-footer text-muted">
    Posted on <?= $post['created_at'] ?> by <a href="#"><?= $post['name'] ?></a>
    </div>
</div>
<?php endwhile; ?>

<!-- Pagination -->
<ul class="pagination justify-content-center mb-4">
    <?php if(isset($_GET['category'])):?>
        <li class="page-item <?php if($page<=1){echo 'disabled';}?>">
            <a class="page-link" href="<?= BASE_URL.'?category='.$_GET['category'].'&page='.($page-1) ?>">&larr; Older</a>
        </li>
        <li class="page-item <?php if($page==$total_page) {echo "disabled";}?>">
            <a class="page-link" href="<?= BASE_URL.'?category='.$_GET['category'].'&page='.($page+1) ?>">Newer &rarr;</a>
        </li>
    <?php else: ?>
        <li class="page-item <?php if($page<=1){echo 'disabled';}?>">
            <a class="page-link" href="<?= BASE_URL.'?page='.($page-1) ?>">&larr; Older</a>
        </li>
        <li class="page-item <?php if($page==$total_page) {echo "disabled";}?>">
            <a class="page-link" href="<?= BASE_URL.'?page='.($page+1) ?>">Newer &rarr;</a>
        </li>
    <?php endif;?>
</ul>

<?php 

include "base_template/home/sidebar.php";
include "base_template/home/footer.php";

?>