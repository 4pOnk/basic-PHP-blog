<?php
require 'DB.php';
$name = $_POST['name'];
$pag = $_POST['pagination'];
$file = $_FILES['file'];
session_start();

if($_SESSION['user'] == 1){
    if($file['size'] == 0) {
        mysqli_query($connection, "UPDATE `admin_panel` SET `name`='$name',`pagination`=$pag WHERE 1");
    }else{
        $path = 'uploads/' . time() . $file['name'];
        move_uploaded_file($file['tmp_name'], '../' . $path);
        mysqli_query($connection, "UPDATE `admin_panel` SET `name`='$name',`pagination`=$pag ,`logo`='$path' WHERE 1");
    }
}

header('Location: /');
