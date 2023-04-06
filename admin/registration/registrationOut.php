<?php
session_start();
unset($_SESSION['studentWithFaculty']);
unset($_SESSION['teacher']);
unset($_SESSION['alert']);
header('Location:../paAdmin.php');
?>