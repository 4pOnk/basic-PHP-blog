<?php
require 'DB.php';
session_start();

$text = $_POST['text'];
$author = $_SESSION['user'];
$post_id = $_GET['post'];

if($text =='' || $text == ' '){
    $_SESSION['comm_msg'] = 'Введите текст комментария';
}else{
    mysqli_query($connection,"INSERT INTO `comments`(`author_id`, `text`, `post_id`) VALUES ('$author','$text','$post_id')");
}

header('Location: /single.php?post=' . $post_id);
