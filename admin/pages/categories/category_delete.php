<?php

require_once "../../../config/connection.php";
require_once "../../../libraries/base_url.php";
require_once "../../../libraries/login_required.php";


$category_id = $_GET['id'];

$sql="DELETE FROM categories WHERE category_id = :category_id";
$stmt = $koneksi->prepare($sql);
$stmt->bindParam(":category_id", $category_id);
$stmt->execute();

header('location:'.BASE_URL_ADMIN.'pages/categories/?page=1');

?>