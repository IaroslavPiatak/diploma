<?php
session_start();
require_once '../connection.php';

if (!$_SESSION['dataOfUser']) // если нет сессии о пользователе , то не даем войти
{
    header('Location:../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/admin/paAdmin.css">
    <title>Личный кабинет</title>
</head>

<body>
    <div class="pa_container">
        <div class="first_container">
            <div class="profile_card">
                <!--Карточка профиля-->
                <div class="profile_card_content">
                    <div class="profile_card_img">
                        <?php

                        $userId = $_SESSION['dataOfUser']['userId'];

                        $check_photo = mysqli_fetch_all(mysqli_query($connect, "SELECT `photo` FROM `studients` WHERE `user_id` = '$userId'"))[0][0];



                        if ($check_photo === NULL) {
                            echo '<img src="../img/student/avatar.png" class="avatar">';
                        } else {
                            $path = '../img/student/avatars/' . $check_photo;
                            $path = str_replace(' ', '', $path);
                            echo '<img class = "avatarChange" src="' . $path . '">';

                        }
                        ?>

                    </div>
                    <div class="name">
                        <?php
                        $userFullName = mysqli_fetch_all(mysqli_query($connect, "SELECT `first_name`, `last_name`, `surname`
                        FROM `studients` WHERE `user_id` = '$userId'"));
                        echo '<span>' . $userFullName[0][1] . ' ' . $userFullName[0][0] . ' ' . $userFullName[0][2] . '</span>';
                        ?>
                    </div>
                    <div class="email">
                        <?php
                        $userEmail = mysqli_fetch_all(mysqli_query($connect, "SELECT email FROM `studients` WHERE `user_id` = '$userId'"))[0][0];
                        echo '<span>' . $userEmail . '</span>';
                        ?>

                    </div>
                    <div class="exit">
                        <a href="../exit.php">Выход</a>
                    </div>
                </div>
            </div>
            <!--Карточки с настройками-->
            <div class="card_content">
                <a href="../general_pages/mail/mail.php">
                    <div class="mail">
                        <div class="content">
                            <div class="text">
                                <span>Почта</span>
                            </div>
                            <div class="img">
                                <img src="../img/admin/card_icon.png" class="icon">
                            </div>
                        </div>
                    </div>
                </a>
                <a href="../general_pages/settings/setting.php">
                    <div class="setting">
                        <div class="content">
                            <div class="text">
                                <span>Настройки</span>
                            </div>
                            <div class="img">
                                <img src="../img/admin/card_icon (1).png" class="icon1">
                            </div>
                        </div>
                    </div>
                </a>

                <a href="homework/homeworkChange.php">
                    <div class="new_user">
                        <div class="content">
                            <div class="text">
                                <span>Конспекты и практики</span>
                            </div>
                            <div class="img">
                                <img src="../img/teacher/notepad_regular_icon_203433.png" class="icon2">
                            </div>
                        </div>
                    </div>
                </a>
                <div class="delete">
                    <div class="content">
                        <div class="text">
                            <span>Заявки на удаление</spam>
                        </div>
                        <div class="img">
                            <img src="../img/admin/notepad_regular_icon_203433 1.png" class="icon1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="second_container">
           
        </div> -->
    </div>
</body>

</html>