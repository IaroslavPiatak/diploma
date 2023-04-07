<?php
session_start();
require_once '../../connection.php';
$userId = $_SESSION['dataOfUser']['userId'];
$userRole = $_SESSION['dataOfUser']['userRole'];
if ($userRole == 1) {
    $table = 'admins';
    $path = 'Location:../../admin/paAdmin.php';
} 
else if ($userRole == 2)
{
    $table = 'teachers';
    $path = 'Location:../../teacher/pa_teacher.php';

}
    
else
{
    $table = 'studients';
    $path = 'Location:../../student/pa_student.php';
}

   
if ($_POST['action'] == 'login') {


    $oldLogin = mysqli_fetch_all((mysqli_query($connect, "SELECT `user_login` FROM `users` WHERE `user_id` = '$userId'")))[0][0];
    $newLogin = $_POST['newLogin'];
    if ($oldLogin === $_POST['oldLogin']) {
        mysqli_query($connect, "UPDATE `users` SET `user_login`='$newLogin' WHERE `user_id` = '$userId'");
        header($path);
    } else {
        print_r('Ошибка');
    }

} elseif ($_POST['action'] == 'password') {

    $oldPassword = mysqli_fetch_all((mysqli_query($connect, "SELECT `user_password` FROM `users` WHERE `user_id` = '$userId'")))[0][0];
    $newPassword = $_POST['newPassword'];
    if ($oldPassword === $_POST['oldPassword']) {
        mysqli_query($connect, "UPDATE `users` SET `user_password`='$newPassword' WHERE `user_id` = '$userId'");
        header($path);
    } else {
        print_r('Ошибка');
    }

} elseif ($_POST['action'] == 'email') {

    $oldEmail = mysqli_fetch_all((mysqli_query($connect, "SELECT `email` FROM `$table` WHERE `user_id` = '$userId'")))[0][0];
    $newEmail = $_POST['newEmail'];
    if ($oldEmail === $_POST['oldEmail']) {
        mysqli_query($connect, "UPDATE `$table` SET `email`='$newEmail' WHERE `user_id` = '$userId'");
        header($path);
    } else {
        print_r('Ошибка');
    }

}
?>