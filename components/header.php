<?php
    session_start();
    require './include/DB.php';
    $user_id = $_SESSION['user'];
    $user_img = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM `users` WHERE `id` = '$user_id'"))['image'];
    $settings = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM `admin_panel`"));
?>
<!DOCTYPE HTML>
<!--
	Future Imperfect by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<head>
    <title>Future Imperfect by HTML5 UP</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
    <link rel="stylesheet" href="assets/css/main.css" />
    <!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
    <!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
</head>
<body <?php if($_GET['menu'] == 1)echo 'class="is-menu-visible"'?>>

<!-- Wrapper -->
<div id="wrapper">

    <!-- Header -->
    <header id="header">
        <h1><a href="/"><?= $settings['name'] ?></a></h1>
        <nav class="main">
            <ul>
                    <?php if(!$_SESSION['user']): ?>
                <li class="menu">
                <a class="fa-user" href="#menu">Menu</a>
                    <?php else: ?>
                <li class="menu user">
                    <a href="#menu"><img src="<?= $user_img ?>"></a>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Menu -->
    <section id="menu">

        <!-- Actions -->
        <?php if(!$_SESSION['user']): ?>
        <section>
            <ul class="actions vertical">
                <li><h3>Login</h3></li>
                <li><h3 style="color: darkred"><?php echo $_SESSION['log_message']; unset($_SESSION['log_message'])?></h3></li>
                <li>
                    <form action="./include/login.php" method="post">
                        <input type="text" name="name" placeholder="Username"><br>
                        <input type="password" name="password" placeholder="Password"><br>
                        <input type="submit" class="button big fit" value="Log In">
                    </form>
                </li>

                <li><h3>Registration</h3></li>
                <li><h3 style="color: darkred"><?php echo $_SESSION['reg_message']; unset($_SESSION['reg_message'])?></h3></li>
                <li>
                    <form action="./include/registration.php" method="post" enctype="multipart/form-data">
                        <input type="text" name="name" placeholder="Username"><br>
                        <input type="password" name="password" placeholder="Password"><br>
                        <input type="file" name="file"><br><br>
                        <input type="submit" class="button big fit" value="Sign up">
                    </form>
                </li>
            </ul>
        </section>
        <?php else: ?>
        <section>
            <ul class="links">
                <?php if($_SESSION['user'] == 1): ?>
                    <li>
                        <a href="/admin_panel.php">
                            <h3>Admin panel</h3>
                        </a>
                    </li>
                <?php endif; ?>
                <li>
                    <a href="/add.php">
                        <h3>Add Post</h3>
                    </a>
                </li>
                <li>
                    <a href="../include/logout.php"><h3>Log Out</h3></a>
                </li>
            </ul>
        </section>
        <?php endif; ?>
    </section>
