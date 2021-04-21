<?php
require 'DB.php';

$author_id = $_GET['id'];

mysqli_query($connection,"UPDATE `users` SET `blocked`=1 WHERE `id` = $author_id");

header('Location: /single.php?post=' . $_GET['post']);
