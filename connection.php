<?php
// подключение к базе данных, в переменную конект передаем функции, с (адрес, логин базы, пароль, название базы)
$connect = mysqli_connect('localhost', 'u1982286_iarosla','u1982286_iarosla','u1982286_iarosla');
// $connect = mysqli_connect('localhost', 'root','','diploma');
mysqli_set_charset($connect, 'utf8'); // задает кодировку (для отображения кириллицы)
if (!$connect){
        die('Error connect to DataBase'); // если не получится подключится , процесс умерает и выводит сообщение
    }
?>