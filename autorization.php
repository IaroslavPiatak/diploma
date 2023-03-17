<?php
session_start();
require_once 'connection.php';
$login = $_POST['login'];
$password = $_POST['password'];

$checkUser = mysqli_fetch_all(mysqli_query($connect, "SELECT * FROM `users` WHERE `user_login` = '$login' AND `user_password` = '$password'"));

if ($checkUser[0][0] == 1) {

    $request = mysqli_fetch_all(mysqli_query($connect, 'SELECT * FROM `users`'));
    $requestUserId = $request[0][0];
    $requestRole = $request[0][1];
    $requestLogin = $request[0][2];
    $requestPassword = $request[0][3];
    $_SESSION['dataOfUser'] =
    [
        'userRole' => $requestRole,
        'userId' => $requestUserId,
        'userLogin' => $requestLogin,
        'userPassword' => $requestPassword
    ];
    if($requestRole == 1)
    {
        header('Location:admin/paAdmin.php');
    }
}

else
{
    print_r('Ошибка');
}


?>