<?php

require_once "../../../config/connection.php";
require_once "../../../libraries/base_url.php";


$user_id = $_GET['id'];

$sql="DELETE FROM users WHERE user_id = :user_id";
$stmt = $koneksi->prepare($sql);
$stmt->bindParam(":user_id", $user_id);
$stmt->execute();

header('location:'.BASE_URL_ADMIN.'pages/users/?page=1');

?>