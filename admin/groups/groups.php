<?php
require_once '../../connection.php';
session_start();
if(!empty($_POST['facultyId']))
{
    $_SESSION['facultyId'] =
        [
            'facultyId' => $_POST['facultyId']
        ];


}


$facultyId = $_SESSION['facultyId']['facultyId'];



// записать в переменную из POST id факультета
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/admin/groups/groups.css">
    <title>Группы</title>
</head>

<body>
    <main>
        <?php
        $countGroups = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `groups`
        WHERE `faculty_id` = '$facultyId'"))[0][0]; // считаем группы, если их 0, выводим код из if
        if ($countGroups == 0) {
            ?>
            <div class="main_container">
                <div class="inner_container">
                    <div class="left_block">
                        <div class="profile_faculty">
                            <div class="profile_setting_content">
                                <div class="img_block">
                                    <img src="/img/admin/groups/groups_icon.png" class="icon2">
                                </div>
                                <div class="title">
                                    <span>Группы</span>
                                </div>
                                <div class="exit">
                                    <a href="../faculty/faculty.php">Вернуться к факультетам</a>
                                </div>
                            </div>
                        </div>
                        <form action="groups_create.php" method="post">
                            <div class="register_faculty">
                                <div class="register_faculty_content">
                                    <div class="text">
                                        <span>Зарегистрировать новую группу</span>
                                    </div>
                                    <div class="img">
                                        <img src="/img/admin/faculty/Group (1).png" class="icon1">
                                    </div>
                                </div>
                                <?
                                echo '<input  name = "facultyId" type="hidden" value="' . $facultyId . '">';
                                ?>
                                <button class="btn_form" type="submit"></button>
                            </div>

                        </form>
                    </div>
                    <div class="right_block">
                        <div class="warning">
                            <div class="warning_content">
                                <div class="warning_img">
                                    <img src="/img/admin/groups/cat.png" class="icon2">
                                </div>
                                <div class="warning_text">
                                    <span>Наш кот - Василий подсказывает, что ни одна группа на данном факультете еще не
                                        зарегистрирована !</span>
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
                                    <img src="/img/admin/groups/groups_icon.png" class="icon2">
                                </div>
                                <div class="title">
                                    <span>Группы</span>
                                </div>
                                <div class="exit">
                                    <a href="../faculty/faculty.php">Вернуться к факультетам</a>
                                </div>
                            </div>
                        </div>
                        <form action="groups_create.php" method="post">
                            <div class="register_faculty">
                                <div class="register_faculty_content">
                                    <div class="text">
                                        <span>Зарегистрировать новую группу</span>
                                    </div>
                                    <div class="img">
                                        <img src="/img/admin/faculty/Group (1).png" class="icon1">
                                    </div>
                                </div>
                                <?
                                echo '<input  name = "facultyId" type="hidden" value="' . $facultyId . '">';
                                ?>
                                <button class="btn_form" type="submit"></button>
                            </div>

                        </form>
                    </div>
                    <div class="right_block"> <!--Запускаем скрипт для правого блока -->
                        <?
                        $arrayOfGroups = mysqli_fetch_all(
                            mysqli_query(
                                $connect,
                                "SELECT `groups_name` FROM `groups` WHERE `faculty_id` = '$facultyId'"
                            )
                        ); // получаем id первой группы
                        $nextGroup = 0;



                        for ($i = 0; $i < $countGroups; $i++) { // заполняем правый блок, пока не будет 6 карточек
                            if ($i == 6) {
                                break;
                            }
                            echo ' <div class="faculty">
                            <div class="faculty_content">
                                <div class="faculty_text">
                                    <span>' . $arrayOfGroups[$nextGroup][0] . '</span>
                                    
                                </div>
                            </div>
                        </div>';
                            $nextGroup++; // увеличиваем id первого элемента, т.е. получаем id 2 элемента
                    
                        }
                        ?>
                    </div>
                </div>
                <?
                if ($countGroups >= 7) { // если факультетов больше или равно 7, то отрисовываем нижний блок
                    ?>
                    <div class="down_block">
                        <?
                        for ($i <= 7; $i < $countGroups; ++$i) { // вывод блоков
                            echo ' <div class="faculty">
                            <div class="faculty_content">
                                <div class="faculty_text">
                                <span>' . $arrayOfGroups[$nextGroup][0] . '</span>
                                    
                                </div>
                            </div>
                        </div>';
                            $nextGroup++;
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