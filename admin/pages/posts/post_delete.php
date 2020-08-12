<?php

require_once "../../../config/connection.php";
require_once "../../../libraries/base_url.php";
require_once "../../../libraries/login_required.php";


$post_id = $_GET['id'];

$sql="DELETE FROM posts WHERE post_id = :post_id";
$stmt = $koneksi->prepare($sql);
$stmt->bindParam(":post_id", $post_id);
$stmt->execute();

header('location:'.BASE_URL_ADMIN.'pages/posts/?page=1');

?>