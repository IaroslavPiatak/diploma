<?
session_start();
$userRole = $_SESSION['dataOfUser']['userRole'];
unset($_SESSION['homework']);

if($userRole == 2)
{
    header('Location:../pa_teacher.php');
}

?>