<?php

require_once "base_url.php";

function upload(){
    
    // print_r($_FILES['gambar']);
    // die;

    $fileName = $_FILES['gambar']['name'];
    $fileSize = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if($error===4){
        echo "<script>
                alert('Pilih gambar terlebih dahulu!');
            </script>";
        return false;
    }

    $validExt = ['jpg','jpeg','png'];
    $fileExt = explode('.', $fileName);
    $fileExt = strtolower(end($fileExt));
    
    if(!in_array($fileExt, $validExt)){
        echo "<script>
                alert('Bukan File gambar!');
            </script>";
        return false;
    }

    // max 1mb
    if($fileSize > 1000000){
        echo "<script>
                alert('Ukuran gambar terlalu besar!');
            </script>";
        return false;
    }
    //change dir to /img
    chdir('../../../img');
    $dirName = getcwd();

    $fileName = uniqid();
    $fileName .= '.';
    $fileName .= $fileExt;

    move_uploaded_file($tmpName, $dirName.'/'. $fileName);

    return $fileName;
}

?>