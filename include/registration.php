<?php
require 'DB.php';
session_start();

$name = $_POST['name'];
$password = $_POST['password'];
$file = $_FILES['file'];
$err = 0;

if($name == '' || $name == ' ' || $password == '' || $password == ' '||$file['size'] == 0||($file['type']!='image/jpeg' && $file['type']!='image/png')){
    if($name == '' || $name == ' '){
        $_SESSION['reg_message'] = "Пожалуйста, введите логин";
    }elseif ($password == '' || $password == ' '){
        $_SESSION['reg_message'] = "Пожалуйста, введите пароль";
    }elseif ($file['size'] == 0){
        $_SESSION['reg_message'] = "Пожалуйста, загрузите изображение";
    }elseif ($file['type']!='image/jpg' && $file['type']!='image/png'){
        $_SESSION['reg_message'] = "Пожалуйста, загрузите изображение в формате PNG/JPG";
    }
    $err = 1;
}
else {
        $path = 'uploads/' . time() . $file['name'];
        move_uploaded_file($file['tmp_name'], '../' . $path);
        mysqli_query($connection,"INSERT INTO `users`(`login`, `password`, `image`) VALUES ('$name','$password','$path')");
        $user_id = mysqli_fetch_assoc(mysqli_query($connection,"SELECT * FROM `users` WHERE `login` = '$name' AND `password` = '$password'"))['id'];
        $_SESSION['user']  = $user_id;
}
if($err == 1){
    header('Location: /index.php?menu=1');
}else {
    header('Location: /');
}