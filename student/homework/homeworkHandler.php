<?php
session_start();
require_once '../../connection.php';
print_r($_FILES);
$userId = $_SESSION['dataOfUser']['userId'];
$studentId = mysqli_fetch_all(mysqli_query($connect, "SELECT `studient_id` FROM `studients` WHERE `user_id` = '$userId'"))[0][0];
$groupId = mysqli_fetch_all(mysqli_query($connect, "SELECT `group_id` FROM `studients` WHERE `user_id` = '$userId'"))[0][0];
$homeworkId = $_POST['idHomework'];
$text = $_POST['text'];
$time = $_POST['time'];
$date = $_POST['date'];

if ($_FILES && $_FILES["filename"]["error"] == UPLOAD_ERR_OK) // Если поле массива error = 0 ИЛИ не имеет ошибок, то загружаем файл
{
    $nameForDataBase = $_FILES["filename"]["name"];
    $userId = $_SESSION['dataOfUser']['userId'];

    $name = 'homeworkDocuments/' . $_FILES["filename"]["name"]; // сохраняем имя файла
    
    mysqli_query($connect, "INSERT INTO `answers`(`senderId`, `groupId`, `homeworkId`, `text`, `time`, `date`, `document`) 
    VALUES ('$studentId','$groupId','$homeworkId','$text','$time ','$date',' $nameForDataBase')");
    move_uploaded_file($_FILES["filename"]["tmp_name"], $name); // в функции передаем временное расположение файла и его имя
}
else
{
    mysqli_query($connect, "INSERT INTO `answers`(`senderId`, `groupId`, `homeworkId`, `text`, `time`, `date`) 
    VALUES ('$studentId','$groupId','$homeworkId','$text','$time ','$date')");

}
header('Location: homeworkHub.php');
?>