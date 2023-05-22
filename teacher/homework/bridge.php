<?
session_start(); 
$_SESSION['homework']['action'] = 'read';
header('Location: homeworkCreate.php');
?>