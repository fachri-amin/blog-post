<?php 

$dbhost = "localhost";
$dbname = "blog_post";
$dbuser = "root";
$dbpass = "";


try {
    $koneksi = new PDO("mysql:host=" . $dbhost . "; dbname=".$dbname."",$dbuser,$dbpass);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
    die;
}

?>