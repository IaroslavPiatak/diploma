<!-- Mady by Iaroslav Piatak (php) -->
<?php
require_once '../../connection.php';
print_r($_POST);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/admin/faculty/faculty.css">
    <title>Факультеты</title>
</head>

<body>
    <main>
        <?php
        $countFaculties = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `faculties`"))[0][0]; // считаем факультеты, если их 0, выводим код из if
        if ($countFaculties == 0) { 
            ?>
            <div class="main_container">
                <div class="inner_container">
                    <div class="left_block">
                        <div class="profile_faculty">
                            <div class="profile_setting_content">
                                <div class="img_block">
                                    <img src="/img/admin/faculty/universitygraduatehat_104965 1.png" class="icon2">
                                </div>
                                <div class="title">
                                    <span>Факультеты</span>
                                </div>
                                <div class="exit">
                                    <a href="../paAdmin.php">Вернуться в личный кабинет</a>
                                </div>
                            </div>
                        </div>
                        <a href="faculty_create.php">
                            <div class="register_faculty">
                                <div class="register_faculty_content">
                                    <div class="text">
                                        <span>Зарегистрировать новый факультет</span>
                                    </div>
                                    <div class="img">
                                        <img src="/img/admin/faculty/Group (1).png" class="icon1">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="right_block">
                        <div class="warning">
                            <div class="warning_content">
                                <div class="warning_img">
                                    <img src="/img/admin/faculty/satellite_sendingthesignal_satelite_3957 1.png"
                                        class="icon2">
                                </div>
                                <div class="warning_text">
                                    <span>Согласно нашим спутникам, ни один факультет еще не зарегистрирован!</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        <?
        } else {
            ?>
            <div class="main_container">
                <div class="inner_container">
                    <div class="left_block">
                        <div class="profile_faculty">
                            <div class="profile_setting_content">
                                <div class="img_block">
                                    <img src="/img/admin/faculty/universitygraduatehat_104965 1.png" class="icon2">
                                </div>
                                <div class="title">
                                    <span>Факультеты</span>
                                </div>
                                <div class="exit">
                                    <a href="../paAdmin.php">Вернуться в личный кабинет</a>
                                </div>
                            </div>
                        </div>
                        <a href="faculty_create.php">
                            <div class="register_faculty">
                                <div class="register_faculty_content">
                                    <div class="text">
                                        <span>Зарегистрировать новый факультет</span>
                                    </div>
                                    <div class="img">
                                        <img src="/img/admin/faculty/Group (1).png" class="icon1">
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="right_block"> <!--Запускаем скрипт для правого блока -->
                        <?
                        $firstFacultyId = mysqli_fetch_all(mysqli_query($connect,
                        "SELECT `faculty_id` FROM `faculties` LIMIT 1"))[0][0]; // получаем id первого факультета
                        
                        for ($i = 0; $i < $countFaculties; $i++) { // заполняем правый блок, пока не будет 6 карточек
                            if ($i == 6) {
                                break;
                            }
                            echo ' <div class="faculty">
                            <div class="faculty_content">
                                <div class="faculty_text">
                                    <span>'
                                    . $facultyName = mysqli_fetch_all(mysqli_query($connect,
                                    "SELECT `faculty_name` FROM `faculties` 
                                    WHERE `faculty_id` = '$firstFacultyId'"))[0][0] . // вытаскиваем имя факультета, по id первого факультета
                                    '</span>
                                    
                                </div>
                            </div>
                        </div>';
                        $firstFacultyId++; // увеличиваем id первого элемента, т.е. получаем id 2 элемента

                        }
                        ?>
                    </div>
                </div>
                <?
                if ($countFaculties >= 7) { // если факультетов больше или равно 7, то отрисовываем нижний блок
                    ?>
                    <div class="down_block">
                        <?
                        for ($i <= 7; $i < $countFaculties; ++$i) { // вывод блоков
                            echo ' <div class="faculty">
                            <div class="faculty_content">
                                <div class="faculty_text">
                                    <span>'
                                    . $facultyName = mysqli_fetch_all(mysqli_query($connect,
                                    "SELECT `faculty_name` FROM `faculties` 
                                    WHERE `faculty_id` = '$firstFacultyId'"))[0][0] . // получение имени по id
                                    '</span>
                                    
                                </div>
                            </div>
                        </div>';
                        $firstFacultyId++;
                        }
                        ?>
                    </div>

                <?
                }
        }
        ?>

    </main>
</body>

</html>