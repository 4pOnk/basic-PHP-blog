<?php
session_start();
require 'DB.php';

$name = $_POST['name'];
$subtitle = $_POST['subtitle'];
$anons = $_POST['anons'];
$content = $_POST['content'];
$file = $_FILES['file'];
$author_id = $_SESSION['user'];

$err = 0;

if($name == '' || $subtitle == '' || $anons == '' || $content == ''){
    $_SESSION['post_message'] = "Пожалуйста, заполните все поля";
    $err = 1;
}
elseif ($file['size'] == 0){
    $_SESSION['post_message'] = "Пожалуйста, загрузите изображение";
}else{
    $path = 'uploads/' . time() . $file['name'];
    move_uploaded_file($file['tmp_name'],'../' . $path);
    mysqli_query($connection, "INSERT INTO `posts`( `name`, `subtitle`, `anons`, `content`, `image`, `author_id`) VALUES ('$name','$subtitle','$anons','$content','$path','$author_id')");
}
if($err == 1){
    header('Location: /add.php');
}
else {
    header('Location: /');
}