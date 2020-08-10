<?php 

$dbhost = "localhost";
$dbname = "blog_post";
$dbuser = "root";
$dbpass = "";

$koneksi = new PDO("mysql:host=" . $dbhost . "; dbname=".$dbname."",$dbuser,$dbpass);

?>