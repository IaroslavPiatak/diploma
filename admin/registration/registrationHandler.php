<?php
require_once '../../connection.php';
session_start();

if($_POST['type_form'] = 'studentFaculties ')
{
    $_SESSION['student'] =
    [
        'userRole' => $_POST['userRole'],
        'lastName' => $_POST['lastName'],
        'name' => $_POST['name'],
        'surname' => $_POST['surname'],
        'email' => $_POST['email'],
        'login' => $_POST['login'],
        'password' => $_POST['password'],
        'facultyId' => $_POST['facultyId'],
    ];
    header('Location:registration.php');

}
?>