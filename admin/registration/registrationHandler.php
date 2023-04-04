<?php
require_once '../../connection.php';
session_start();
if ($_POST['type_form'] == 'studentFaculties') {
    if (isset($_SESSION['studentWithFaculty']))
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

} elseif ($_POST['type_form'] == 'studentGroups') {

    $_SESSION['studentWithFaculty']['groupId'] = $_POST['groupId'];
    $_SESSION['studentWithFaculty']['studentFinal'] = 'true';
    header('Location: registration.php');

} elseif ($_POST['type_form'] == 'studentBackToGroups') {
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
} elseif ($_POST['type_form'] == 'teacherBackToSubjects') {
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
} elseif (($_POST['type_form'] == 'studentRegister')) {
    $login = $_SESSION['studentWithFaculty']['login'];
    $password = $_SESSION['studentWithFaculty']['password'];
    $checkLogin = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `users` WHERE `user_login` = '$login'"))[0][0];

    if ($checkLogin == 0) {
        mysqli_query($connect, "INSERT INTO `users`(`user_role`, `user_login`, `user_password`) VALUES ('3',
    '$login', '$password')");

        $user_id = mysqli_fetch_all(mysqli_query($connect, "SELECT `user_id` FROM `users` WHERE `user_login` = '$login' AND `user_password` = '$password'"))[0][0];
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
    else
    {
        $_SESSION['alert'] =
            [
                'alert' => 'true'
            ];
        header('Location: registration.php');

    }



} elseif (($_POST['type_form'] == 'teacherRegister')) {

    $login = $_SESSION['teacher']['login'];
    $password = $_SESSION['teacher']['password'];

    $checkLogin = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `users` WHERE `user_login` = '$login'"))[0][0];
    if ($checkLogin == 0) {
        mysqli_query($connect, "INSERT INTO `users`(`user_role`, `user_login`, `user_password`) VALUES ('2',
        '$login', '$password')");

        $user_id = mysqli_fetch_all(mysqli_query($connect, "SELECT `user_id` FROM `users` WHERE `user_login` = '$login' AND `user_password` = '$password'"))[0][0];
        $lastName = $_SESSION['teacher']['lastName'];
        $name = $_SESSION['teacher']['name'];
        $surname = $_SESSION['teacher']['surname'];
        $email = $_SESSION['teacher']['email'];

        mysqli_query($connect, "INSERT INTO `teachers`(`user_id`, `last_name`, `first_name`, `surname`, `email`) 
        VALUES ($user_id,'$lastName','$name','$surname','$email')");

        $countOfSubjects = $_SESSION['teacher']['countOfSubjects'];
        $teacher_id = mysqli_fetch_all(mysqli_query($connect, "SELECT `teacher_id` FROM `teachers` WHERE  `user_id` = '$user_id'"))[0][0];
        for ($i = 0; $i < $countOfSubjects; $i++) {
            $subject_id = $_SESSION['teacher']['subject' . $i];
            mysqli_query($connect, "INSERT INTO `teachers-subjects`(`id_teacher`, `id_subject`) VALUES ('$teacher_id','$subject_id')");

        }
        header('Location: registrationOut.php');

    } else {
        $_SESSION['alert'] =
            [
                'alert' => 'true'
            ];
        header('Location: registration.php');
    }



} elseif (($_POST['type_form'] == 'adminRegister')) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $checkLogin = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `users` WHERE `user_login` = '$login'"))[0][0];
    if($checkLogin == 0)
    {
         mysqli_query($connect, "INSERT INTO `users`(`user_role`, `user_login`, `user_password`) VALUES ('1',
    '$login', '$password')");

    $user_id = mysqli_fetch_all(mysqli_query($connect, "SELECT `user_id` FROM `users` WHERE `user_login` = '$login' AND `user_password` = '$password'"))[0][0];
    $lastName = $_POST['lastName'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    mysqli_query($connect, "INSERT INTO `admins`(`user_id`, `last_name`, `first_name`, `surname`, `email`) 
    VALUES ($user_id,'$lastName','$name','$surname', '$email')");
    header('Location: registrationOut.php');

    }
    else
    {
        $_SESSION['alert'] =
            [
                'alert' => 'true'
            ];
        header('Location: registration.php');
    }
   


} elseif (($_POST['type_form'] == 'teacherNextFinal')) {
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
    for ($i = 0; $i < $_POST['countOfSubjects']; $i++) {
        if (isset($_POST['subject' . $i])) {
            $_SESSION['teacher']['subject' . $numberOfSubject] = $_POST['subject' . $i];
            $numberOfSubject++;
        } else {
            continue;
        }
    }
    $_SESSION['teacher']['countOfSubjects'] = $numberOfSubject;
    $_SESSION['teacher']['teacherFinal'] = 'true';
    header('Location: registration.php');
} else {
    header('Location: registration.php');
}




?>