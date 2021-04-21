<?php
require 'DB.php';
session_start();

$name = $_POST['name'];
$password = $_POST['password'];
$err = 0;
$ban = 0;

if($name == '' || $name == ' ' || $password == '' || $password == ' '){
    if($name == '' || $name == ' '){
        $_SESSION['log_message'] = "Пожалуйста, введите логин";
    }elseif ($password == '' || $password == ' '){
        $_SESSION['log_message'] = "Пожалуйста, введите пароль";
    }
}
else {
    $user = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM `users` WHERE `login` = '$name' AND `password` = '$password'"));
    if($user['blocked'] == 1){
        $ban = 1;
    }else {
        if ($user['id']) {
            $_SESSION['user'] = $user['id'];
        } else {
            $_SESSION['log_message'] = "Пользователь не найден";
        }
        $err = 1;
    }
}

if($ban == 1){
    header('Location: /blocked.php');
}
else if($err == 1){
header('Location: /index.php?menu=1');
}else {
    header('Location: /');
}