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
    <title>Администратор</title>
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

                        $check_photo = mysqli_fetch_all(mysqli_query($connect, "SELECT `photo` FROM `admins` WHERE `user_id` = '$userId'"))[0][0];



                        if ($check_photo === NULL) {
                            echo '<img src="../img/admin/avatar.png" class="avatar">';
                        } else {
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
                </div>
            </div>
            <!--Карточки с настройками-->
            <div class="card_content">
                <button onClick='location.href="../general_pages/mail/mail.php"' class="mail">
                    <div class="content">
                        <div class="text">
                            <span>Почта</span>
                        </div>
                        <div class="img">
                            <img src="../img/admin/card_icon.png" class="icon">
                        </div>
                    </div>
                </button>
                <button onClick='location.href="../general_pages/settings/setting.php"' class="setting">
                    <div class="content">
                        <div class="text">
                            <span>Настройки</span>
                        </div>
                        <div class="img">
                            <img src="../img/admin/card_icon (1).png" class="icon1">
                        </div>
                    </div>

                </button>

                <a href="registration/registration.php">
                    <div class="new_user">
                        <div class="content">
                            <div class="text">
                                <span>Зарегистрировать нового пользователя</span>
                            </div>
                            <div class="img">
                                <img src="../img/admin/adduser_105070 1.png" class="icon2">
                            </div>
                        </div>
                    </div>
                </a>
                <div class="delete">
                    <div class="content">
                        <div style="display: flex; flex-direction: column;" class="text">
                            <span id="dateCard">Рассчитываем время...</span>
                            <span style="margin-top: 10px;" id="dateCardTime">Рассчитываем дату...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="second_container">
            <a href="faculty/faculty.php">
                <div class="facultative">
                    <div class="content">
                        <div class="text">
                            <span>Факультеты и группы</span>
                        </div>
                        <div class="img">
                            <img src="../img/admin/universitygraduatehat_104965 1.png" class="icon1">
                        </div>
                    </div>
                </div>
            </a>
            <a href="subject/subject.php">
                <div class="items">
                    <div class="content">
                        <div class="text">
                            <span>Предметы</span>
                        </div>
                        <div class="img">
                            <img src="../img/admin/Vector (9).png" class="icon1">
                        </div>
                    </div>
                </div>
            </a>
            <a href="../exit.php">
                <div class="shedule">
                    <div class="content">
                        <div class="text">
                            <span style="color: #EC5863;">Выход</span>
                        </div>
                        <div class="img">
                            <img src="../img/admin/Vector.png" class="icon1">
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <script>
        const intervalId = setInterval(function () {
            const dateCard = document.getElementById('dateCard');
            const dateCardTime = document.getElementById('dateCardTime');
            let date = new Date();
            let hours = (date.getHours());
            if (hours < 10)
                hours = '0' + hours;
            let minutes = (date.getMinutes());
            if (minutes < 10)
                minutes = '0' + minutes;
            let seconds = (date.getSeconds());
            if (seconds < 10)
                seconds = '0' + seconds;
            let day = (date.getDate());
            if (day < 10)
                day = '0' + day;
            let month = (date.getMonth());
            if (month < 10)
                month++;
            month = '0' + month;
            let year = (date.getFullYear());
            dateCard.innerHTML = hours + ':' + minutes + ':' + seconds;
            let dayOfWeek = date.getDay();
            dateCardTime.innerHTML = day + '.' + month + '.' + year + ' Воскресенье';


        }, 1000);


    </script>
</body>

</html>