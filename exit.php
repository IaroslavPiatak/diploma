<?php
session_start();
if($_SESSION['dataOfUser'])
{
    session_destroy();
    header('Location:index.php');
}
?>