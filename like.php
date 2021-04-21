<?php
require 'include/DB.php';
$post_id = $_GET['post'];
$post = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM `posts` WHERE `id` = $post_id "));
$post_author_id = $post['author_id'];

$ind = $_GET['page'];

session_start();

if(!$_COOKIE['like_' . $_SESSION['user'] . '_' . $post_id]){
    setcookie('like_' . $_SESSION['user'] . '_' . $post_id, true);
    mysqli_query($connection,"UPDATE `users` SET `likes`=`likes` + 1 WHERE `id` = $post_author_id");
    mysqli_query($connection,"UPDATE `posts` SET `likes`=`likes` + 1 WHERE `id` = $post_id");
} else{
    setcookie('like_' . $_SESSION['user'] . '_' . $post_id, false);
    mysqli_query($connection,"UPDATE `users` SET `likes`=`likes` - 1 WHERE `id` = $post_author_id");
    mysqli_query($connection,"UPDATE `posts` SET `likes`=`likes` - 1 WHERE `id` = $post_id");
}

if($ind != '') {
    header('Location: /index.php?page=' . $ind);
}else{
    header('Location: /single.php?post=' . $post_id);
}