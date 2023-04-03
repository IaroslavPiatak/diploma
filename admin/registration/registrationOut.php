<?php
session_start();
unset($_SESSION['studentWithFaculty']);
unset($_SESSION['teacher']);
header('Location:../paAdmin.php');
?>