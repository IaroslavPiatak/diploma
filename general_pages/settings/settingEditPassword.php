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
    <link rel="stylesheet" href="../../css/general_pages/settings/settingEdit.css">
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
                   <div class="form_block">
                    <div class="form_block_content">
                        <form action = "settingEdit.php" method = "post">
                            <input type = "password" class="text_input" name="oldPassword" placeholder = "Введите старый пароль">
                            <input type = "password" class="text_input" name="newPassword" placeholder = "Введите новый пароль">
                            <input type="hidden" name="action" value="password"  hiden>
                            <button type = "submit">Подтвердить</button>
                        </form>

                    </div>

                   </div>
                </div>
            </div>




        </div>

    </main>

</body>

</html>