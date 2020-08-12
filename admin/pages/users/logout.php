<?php

include_once "../../../libraries/base_url.php";

session_start();
session_destroy();

header('location:' . BASE_URL);

?>

