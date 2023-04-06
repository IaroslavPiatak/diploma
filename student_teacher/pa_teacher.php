<?php
// подключение к базе данных, в переменную конект передаем функции, с (адрес, логин базы, пароль, название базы)

    $connect = mysqli_connect('localhost', 'root','','diploma');
    mysqli_set_charset($connect, 'utf8'); // задает кодировку (для отображения кириллицы)

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/pa_teacher.css">
    <title>Личный кабинет учителя</title>
</head>
<body>
    <div class="main_contanier">
    <div class="pa_container">
        <div class="teacher_container">
            <div class="profile_card">
                <div class="profile_card_content">
                    <div class="profile_card_img">
                    <?php

                    $userId = $_SESSION['dataOfUser']['userId'];

                    $check_photo = mysqli_fetch_all(mysqli_query($connect, "SELECT `photo` FROM `admins` WHERE `user_id` = '$userId'"))[0][0];



                    if ($check_photo === NULL) {
                    echo '<img src="img/avatar.png" class="avatar">';
                    } 
                    else {
                    $path = '../img/admin/avatars/' . $check_photo;
                    $path = str_replace(' ', '', $path);
                    echo '<img class = "avatarChange" src="' . $path . '">';

                    }
                    ?>
                    </div>
                    <div class="name">
                    <?php
                        $userFullName = mysqli_fetch_all(mysqli_query($connect, "SELECT `first_name`, `last_name`, `surname`
                        FROM `admins` WHERE `user_id` = '$userId'"));
                        echo '<span>' . $userFullName[0][1] . ' ' . $userFullName[0][0] . ' ' . $userFullName[0][2] . '</span>';
                        ?>
                    </div>
                    <div class="email">
                    <?php
                        $userEmail = mysqli_fetch_all(mysqli_query($connect, "SELECT email FROM `admins` WHERE `user_id` = '$userId'"))[0][0];
                        echo '<span>' . $userEmail . '</span>';
                        ?>
                    </div>
                    <div class="exit">
                    <a href="../exit.php">Выход</a>
                    </div>
                </div>
            </div>
            <div class="card_content">
            <a href="#">
                <div class="mail">
                     <div class="content">
                        <div class="text">
                            <span>Почта</span>
                        </div>
                        <div class="img">
                            <img src="img/mail.png" class="icon">
                        </div>
                    </div>
                </div>
                </a>
                <a href="#">
                <div class="settings">
                    <div class="content">
                       <div class="text">
                           <span>Настройки</span>
                       </div>
                       <div class="img">
                           <img src="img/card_icon.png" class="icon">
                       </div>
                   </div>
               </div>
                </a>
                <a href="#">
               <div class="journal">
                    <div class="content">
                        <div class="text">
                            <span>Журнал</span>
                        </div>
                        <div class="img">
                            <img src="img/adduser.png" class="icon">
                        </div>
                    </div>
               </div>
                </a>
                <a href="#">
                <div class="other">
                    <div class="content">
                        <div class="text">
                            <span>Конспекты и ДЗ</span>
                         </div>
                        <div class="img">
                            <img src="img/notepad_icon.png" class="icon">
                        </div>
                    </div>
                </div>
                </a>
            </div>
        </div>
        <div class="shedule">
            <img src="img/shedule.png" class="shedule_img">
        </div>
    </div>
    </div>
</body>
</html>