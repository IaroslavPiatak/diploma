<!-- Made by Iaroslav Piatak -->
<?php
session_start();
require_once '../../connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/general_pages/settings/settingEditPhoto.css">
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
                                <span>Вернуться в личный кабинет</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right_block">
                   <div class="form_block">
                    <div class="form_block_content">
                        <?php
                        if ($_FILES && $_FILES["filename"]["error"]== UPLOAD_ERR_OK) // Если поле массива error = 0 ИЛИ не имеет ошибок, то загружаем файл
                        {   $nameForDataBase = $_FILES["filename"]["name"]; 
                            $userId = $_SESSION['dataOfUser']['userId'];
                            $name = '../../img/admin/avatars/' . $_FILES["filename"]["name"]; // сохраняем имя файла
                            move_uploaded_file($_FILES["filename"]["tmp_name"], $name); // в функции передаем временное расположение файла и его имя
                            mysqli_query($connect,"UPDATE `admins` SET `photo`=' $nameForDataBase' WHERE `user_id` = '$userId'");
                            echo "Файл загружен";
                        }
    
                        
                        ?>
                        <form method="post" enctype="multipart/form-data">
                            <div class="input_back">
                                <input class="input_photo" type="file" name="filename" size="10" accept="image/*,image/jpeg" />
                                <div class="input_back_text">
                                    <span>Загрузите фото вашего профиля</span>
                                </div>
                                <div class="input_back_photo"></div>
                            </div>
                            <button type="submit">Подтвердить</button>
                        </form>

                        
        
                    </div>

                   </div>
                </div>
            </div>




        </div>

    </main>

</body>

</html>