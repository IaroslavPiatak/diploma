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
                      
                            <?php
                            if ($_FILES && $_FILES["filename"]["error"] == UPLOAD_ERR_OK) // Если поле массива error = 0 ИЛИ не имеет ошибок, то загружаем файл
                            {
                                $nameForDataBase = $_FILES["filename"]["name"];
                                $userId = $_SESSION['dataOfUser']['userId'];
                                $userRole = $_SESSION['dataOfUser']['userRole'];
                                if($userRole == 1)
                                {
                                    $name = '../../img/admin/avatars/' . $_FILES["filename"]["name"]; // сохраняем имя файла
                                    move_uploaded_file($_FILES["filename"]["tmp_name"], $name); // в функции передаем временное расположение файла и его имя
                                    
                                    $oldPhoto = mysqli_fetch_all(mysqli_query($connect, "SELECT `photo` FROM `admins` WHERE `user_id` = '$userId'"))[0][0];
                                    if ($oldPhoto === NULL) {
                                      
                                      
                                        mysqli_query($connect, "UPDATE `admins` SET `photo`=' $nameForDataBase' WHERE `user_id` = '$userId'");
                                        header('Location:../../admin/paAdmin.php');
    
                                    } else {
                                        
                                        
                                        mysqli_query($connect, "UPDATE `admins` SET `photo`=' $nameForDataBase' WHERE `user_id` = '$userId'");
                                        $oldPhotoPath = '../../img/admin/avatars/' . $oldPhoto;
                                        $oldPhotoPath = str_replace(' ', '', $oldPhotoPath);
                                        unlink($oldPhotoPath);
                                        header('Location:../../admin/paAdmin.php');
    
                                    }
                                }
                                else if ($userRole == 2)
                                {
                                    $name = '../../img/teacher/avatars/' . $_FILES["filename"]["name"]; // сохраняем имя файла
                                    move_uploaded_file($_FILES["filename"]["tmp_name"], $name); // в функции передаем временное расположение файла и его имя
                                    
                                    $oldPhoto = mysqli_fetch_all(mysqli_query($connect, "SELECT `photo` FROM `teachers` WHERE `user_id` = '$userId'"))[0][0];
                                    if ($oldPhoto === NULL) {
                                      
                                      
                                        mysqli_query($connect, "UPDATE `teachers` SET `photo`=' $nameForDataBase' WHERE `user_id` = '$userId'");
                                        header('Location:../../teacher/pa_teacher.php');
    
                                    } else {
                                        
                                        
                                        mysqli_query($connect, "UPDATE `teachers` SET `photo`=' $nameForDataBase' WHERE `user_id` = '$userId'");
                                        $oldPhotoPath = '../../img/teacher/avatars/' . $oldPhoto;
                                        $oldPhotoPath = str_replace(' ', '', $oldPhotoPath);
                                        unlink($oldPhotoPath);
                                        header('Location:../../teacher/pa_teacher.php');
    
                                    }
                                }
                                else
                                {
                                    $name = '../../img/student/avatars/' . $_FILES["filename"]["name"]; // сохраняем имя файла
                                    move_uploaded_file($_FILES["filename"]["tmp_name"], $name); // в функции передаем временное расположение файла и его имя
                                    
                                    $oldPhoto = mysqli_fetch_all(mysqli_query($connect, "SELECT `photo` FROM `studients` WHERE `user_id` = '$userId'"))[0][0];
                                    if ($oldPhoto === NULL) {
                                      
                                      
                                        mysqli_query($connect, "UPDATE `studients` SET `photo`=' $nameForDataBase' WHERE `user_id` = '$userId'");
                                        header('Location:../../student/pa_student.php');
    
                                    } else {
                                        
                                        
                                        mysqli_query($connect, "UPDATE `studients` SET `photo`=' $nameForDataBase' WHERE `user_id` = '$userId'");
                                        $oldPhotoPath = '../../img/student/avatars/' . $oldPhoto;
                                        $oldPhotoPath = str_replace(' ', '', $oldPhotoPath);
                                        unlink($oldPhotoPath);
                                        header('Location:../../student/pa_student.php');
    
                                    }
                                }
                            
                               



                            }


                            ?>
                            <form method="post" enctype="multipart/form-data">
                                <div class="input_back">
                                    <input class="input_photo" type="file" name="filename" size="10"
                                        accept="image/*,image/jpeg" />
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
    <script>

         const text = document.querySelector('.input_back_text');
         const input = document.querySelector('.input_photo');
         input.addEventListener("input", (event) => {
            text.innerHTML = `<span>Ваша фотография готова к загрузке</span>`;
         });
         
    </script>
  

</body>

</html>