<?php
require_once '../../connection.php';
session_start();
if($_POST['type_form'] == 'studentFaculties')
{
    if(isset($_SESSION['studentWithFaculty']))
    unset($_SESSION['studentWithFaculty']);

    $_SESSION['studentWithFaculty'] =
[
    'lastName' => $_POST['lastName'],
    'name' => $_POST['name'],
    'surname' => $_POST['surname'],
    'email' => $_POST['email'],
    'login' => $_POST['login'],
    'password' => $_POST['password'],
    'facultyId' => $_POST['facultyId'],
    'studentFinal' => 'false'

];
header('Location: registration.php');

}

elseif($_POST['type_form'] == 'studentGroups')
{
    
    $_SESSION['studentWithFaculty']['groupId'] = $_POST['groupId'];
    $_SESSION['studentWithFaculty']['studentFinal'] = 'true';
    header('Location: registration.php');
   
}

elseif($_POST['type_form'] == 'studentBackToGroups')
{
    $_SESSION['studentWithFaculty'] =
[
    'lastName' => $_POST['lastName'],
    'name' => $_POST['name'],
    'surname' => $_POST['surname'],
    'email' => $_POST['email'],
    'login' => $_POST['login'],
    'password' => $_POST['password'],
    'facultyId' => $_POST['facultyId'],
    'studentFinal' => 'false'

];
header('Location: registration.php');
}

elseif($_POST['type_form'] == 'teacherBackToSubjects')
{
    $_SESSION['teacher'] =
[
    'lastName' => $_POST['lastName'],
    'name' => $_POST['name'],
    'surname' => $_POST['surname'],
    'email' => $_POST['email'],
    'login' => $_POST['login'],
    'password' => $_POST['password'],
    'facultyId' => $_POST['facultyId'],
    'teacherFinal' => 'false'

];
header('Location: registration.php');
}

elseif (($_POST['type_form'] == 'studentRegister'))
{
    $login = $_SESSION['studentWithFaculty']['login'];
    $password = $_SESSION['studentWithFaculty']['password'];
    mysqli_query($connect, "INSERT INTO `users`(`user_role`, `user_login`, `user_password`) VALUES ('3',
    '$login', '$password')");

    $user_id =  mysqli_fetch_all(mysqli_query($connect, "SELECT `user_id` FROM `users` WHERE `user_login` = '$login' AND `user_password` = '$password'"))[0][0];
    $lastName = $_SESSION['studentWithFaculty']['lastName'];
    $name = $_SESSION['studentWithFaculty']['name'];
    $surname = $_SESSION['studentWithFaculty']['surname'];
    $email = $_SESSION['studentWithFaculty']['email'];
    $facultyId = $_SESSION['studentWithFaculty']['facultyId'];
    $groupId = $_SESSION['studentWithFaculty']['groupId'];
    mysqli_query($connect, "INSERT INTO `studients`(`user_id`, `last_name`, `first_name`, `surname`, `email`, `faculty_id`, `group_id`) 
    VALUES ($user_id,'$lastName','$name','$surname','$email',$facultyId,$groupId)");
    header('Location: registrationOut.php');
    
   
}

elseif (($_POST['type_form'] == 'test'))
{
    $_SESSION['teacher'] =
[
    'lastName' => $_POST['lastName'],
    'name' => $_POST['name'],
    'surname' => $_POST['surname'],
    'email' => $_POST['email'],
    'login' => $_POST['login'],
    'password' => $_POST['password'],
    'teacherFinal' => 'false'
];
    $numberOfSubject = 0;
    for($i = 0; $i < $_POST['countOfSubjects']; $i++)
    {
        if(isset($_POST['subject'.$i]))
        {
            $_SESSION['teacher']['subject'.$numberOfSubject] = $_POST['subject'.$i];
            $numberOfSubject++;
        }
        else
        {
            continue;
        }
    }
    $_SESSION['teacher']['countOfSubjects'] = $numberOfSubject;
    $_SESSION['teacher']['teacherFinal'] = 'true';
    header('Location: registration.php');
}

else
{
    header('Location: registration.php');
}




?>