<?php
session_start();
require_once '../connection.php';
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
                            echo '<img src="' . $path . '">';

                        }
                        ?>

                    </div>
                    <div class="name">
                        <span>Пятак Ярослав Алексеевич</span>
                    </div>
                    <div class="email">
                        <span>slavikipp@gmail.com</span>
                    </div>
                    <div class="exit">
                        <a href="../index.html">Выход</a>
                    </div>
                </div>
            </div>
            <!--Карточки с настройками-->
            <div class="card_content">
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
                <a href="../general_pages/settings/setting.html">
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
        <div class="second_container">
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
            <div class="shedule">
                <div class="content">
                    <div class="text">
                        <span>Учебное расписание</span>
                    </div>
                    <div class="img">
                        <img src="../img/admin/calendar_day_month_date_year_schedule_icon_175594 1.png" class="icon1">
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>