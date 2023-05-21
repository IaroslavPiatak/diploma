<?
session_start();
$userRole = $_SESSION['dataOfUser']['userRole'];
unset($_SESSION['homework']);


header('Location:../pa_student.php');


?>