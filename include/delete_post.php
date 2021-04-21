<?php
require 'DB.php';

$post_id = $_GET['post'];
$post = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM `posts` WHERE `id` = $post_id"));


unlink('../' . $post['image']);
mysqli_query($connection, "DELETE FROM `posts` WHERE `id` = $post_id");

header('Location: /');