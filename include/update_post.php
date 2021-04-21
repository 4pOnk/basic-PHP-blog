<?php
$post_id = $_GET['post'];

session_start();
require 'DB.php';

$name = $_POST['name'];
$subtitle = $_POST['subtitle'];
$anons = $_POST['anons'];
$content = $_POST['content'];
$file = $_FILES['file'];
$author_id = $_SESSION['user'];



if ($file['size'] == 0){
    mysqli_query($connection, "UPDATE `posts` SET `name`='$name',`subtitle`='$subtitle',`anons`='$anons',`content`='$content' WHERE `id` = $post_id");
}else{
    $path = 'uploads/' . time() . $file['name'];
    move_uploaded_file($file['tmp_name'],'../' . $path);
    mysqli_query($connection, "UPDATE `posts` SET `name`='$name',`subtitle`='$subtitle',`anons`='$anons',`content`='$content',`image`='$path' WHERE `id` = $post_id");
}

header('Location: /');
