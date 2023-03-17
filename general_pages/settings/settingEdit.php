<?php
session_start();
require_once '../../connection.php';

if ($_POST['action'] == 'login') {

    $userId = $_SESSION['dataOfUser']['userId'];
    $oldLogin = mysqli_fetch_all((mysqli_query($connect, "SELECT `user_login` FROM `users` WHERE `user_id` = '$userId'")))[0][0];
    $newLogin = $_POST['newLogin'];
    if ($oldLogin === $_POST['oldLogin']) {
        mysqli_query($connect, "UPDATE `users` SET `user_login`='$newLogin' WHERE `user_id` = '$userId'");
        header('Location:../../admin/paAdmin.php');
    } else {
        print_r('Ошибка');
    }

}

elseif($_POST['action'] == 'password')
{
    $userId = $_SESSION['dataOfUser']['userId'];
    $oldPassword = mysqli_fetch_all((mysqli_query($connect, "SELECT `user_password` FROM `users` WHERE `user_id` = '$userId'")))[0][0];
    $newPassword = $_POST['newPassword'];
    if ($oldPassword === $_POST['oldPassword']) {
        mysqli_query($connect, "UPDATE `users` SET `user_password`='$newPassword' WHERE `user_id` = '$userId'");
        header('Location:../../admin/paAdmin.php');
    } else {
        print_r('Ошибка');
    }

}

elseif($_POST['action'] == 'email')
{
    $userId = $_SESSION['dataOfUser']['userId'];
    $oldEmail = mysqli_fetch_all((mysqli_query($connect, "SELECT `email` FROM `admins` WHERE `user_id` = '$userId'")))[0][0];
    $newEmail = $_POST['newEmail'];
    if ($oldEmail === $_POST['oldEmail']) {
        mysqli_query($connect, "UPDATE `admins` SET `email`='$newEmail' WHERE `user_id` = '$userId'");
        header('Location:../../admin/paAdmin.php');
    } else {
        print_r('Ошибка');
    }

}
?>