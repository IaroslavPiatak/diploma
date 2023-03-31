<?php
session_start();
unset($_SESSION['studentWithFaculty']);
header('Location:../paAdmin.php');
?>