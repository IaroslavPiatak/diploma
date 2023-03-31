<?php
session_start();
$_SESSION['student'] = [ ];
header('Location:../paAdmin.php');
?>