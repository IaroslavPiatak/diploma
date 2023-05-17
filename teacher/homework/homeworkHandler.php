<?php
session_start();
require_once '../../connection.php';
$status = $_POST['status'];
$groupId = $_POST['groupId'];
$subjectId = $_POST['subjectId'];
$typeOfHomework = $_POST['typeOfHomework'];
$theme = $_POST['theme'];
$text_homework = $_POST['text_homework'];
$time = $_POST['time'];
$date = $_POST['date'];
$deadline_of_work = $_POST['deadline_of_work'];
if ($_FILES && $_FILES["filename"]["error"] == UPLOAD_ERR_OK) // Если поле массива error = 0 ИЛИ не имеет ошибок, то загружаем файл
{
    $nameForDataBase = $_FILES["filename"]["name"];
    $userId = $_SESSION['dataOfUser']['userId'];
    $userRole = $_SESSION['dataOfUser']['userRole'];

    $name = 'homeworkDocuments/' . $_FILES["filename"]["name"]; // сохраняем имя файла
    
    mysqli_query($connect, "INSERT INTO `homeworks`(`status`, `groupId`, `subjectId`, `typeOfHomework`, `theme`, `textHomework`, `time`, `date`, `deadlineOfHomework`, `document`) 
    VALUES ('$status','$groupId','$subjectId','$typeOfHomework','$theme','$text_homework','$time','$date','$deadline_of_work','$nameForDataBase')");
    move_uploaded_file($_FILES["filename"]["tmp_name"], $name); // в функции передаем временное расположение файла и его имя

    


}
// header('Location: homeworkExit.php');
?>