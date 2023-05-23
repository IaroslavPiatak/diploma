<?
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/general_pages/settings/setting.css">
    <title>Настройки</title>
</head>

<body>
    <main>
        <div class="content_container">

            <div class="setting_container">
                <div class="left_block">
                    <div class="card_setting">
                        <div class="card_setting_content">
                            <div class="img_block">
                                <img>
                            </div>
                            <div class="title">
                                <span>Настройки</span>
                            </div>

                            <div class="exit">
                                <?
                                $checkUserRole = $_SESSION['dataOfUser']['userRole'];
                                if($checkUserRole == 1)
                                {
                                    ?>
                                   <a href="../../admin/paAdmin.php">Вернуться в личный кабинет</a>
                                    <?
                
                                }
                                else if($checkUserRole == 2)
                                {
                                    ?>
                                   <a href="../../teacher/pa_teacher.php">Вернуться в личный кабинет</a>
                                    <?
                
                                }
                                else
                                {
                                    ?>
                                   <a href="../../student/pa_student.php">Вернуться в личный кабинет</a>
                                    <?
                
                                }
                                
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right_block">
                    <a class = "a"href="../../general_pages/settings/settingEditLogin.php">
                        <div class="card_setting_action">
                            <div class="card_setting_action_title">
                                <span>Изменить логин</span>
                            </div>
                            <div class="card_setting_action_img">
                                <img src="../../img/general_pages/settings/login_edit.png" alt="инокна изменения">
                            </div>
                        </div>
                    </a>
                    <a class = "a" href="../../general_pages/settings/settingEditPassword.php">
                        <div class="card_setting_action">
                            <div class="card_setting_action_title">
                                <span>Изменить пароль</span>
                            </div>
                            <div class="card_setting_action_img">
                                <img src="../../img/general_pages/settings/password_edit.png" alt="инокна изменения">
                            </div>
                        </div>
                    </a>

                    <a class = "a" href="../../general_pages/settings/settingEditEmail.php">
                        <div class="card_setting_action">
                            <div class="card_setting_action_title">
                                <span>Изменить адрес электронной почты</span>
                            </div>
                            <div class="card_setting_action_img">
                                <img src="../../img/general_pages/settings/mail_edit.png" alt="инокна изменения">
                            </div>
                        </div>
                    </a>

                    <a class = "a" href="../../general_pages/settings/settingEditPhoto.php">
                        <div class="card_setting_action">
                            <div class="card_setting_action_title">
                                <span>Изменить фото профиля</span>
                            </div>
                            <div class="card_setting_action_img">
                                <img src="../../img/general_pages/settings/photo_edit.png" alt="инокна изменения">
                            </div>
                        </div>
                    </a>
                </div>
            </div>




        </div>

    </main>
    <script src="../../js/hoverAndAction.js"></script>

</body>

</html>