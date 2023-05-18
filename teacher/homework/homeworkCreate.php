<?
require_once '../../connection.php';
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Домашка</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/teacher/homeworkCreate.css">
</head>

<body>
    <?
    if (isset($_POST['action']) && $_POST['action'] == 'read') {
        $idHomework = $_POST['idHomework'];
        $groupId = $_SESSION['homework']['groupId'];
        $groupName = mysqli_fetch_all(mysqli_query($connect, "SELECT `groups_name` FROM `groups` WHERE `groups_id` = '$groupId'"))[0][0];
        ?>
        <div class="main_container">
            <form action=" " method="post">
                <div class="header">
                    <div class="destination_container">
                        <div class="left_container"><span>Группа :</span></div>
                        <div class="right_container">
                            <span>
                                <?= $groupName ?>
                            </span>
                        </div>
                    </div>

                    <div class="typeOfHomework">
                        <?
                        $typeOfHomework = mysqli_fetch_all(mysqli_query($connect, "SELECT `typeOfHomework` FROM `homeworks` WHERE `id_homework` = '$idHomework'"))[0][0];
                        if ($typeOfHomework == 'abstract')
                            echo '<span class = "forJS">Конспект</span>';
                        else
                            echo '<span class = "forJS">Практика</span>';
                        ?>
                    </div>
                    <button type="button" class="button_header exit"
                        onClick='location.href="homeworkHub.php"'>Назад</button>

                </div>

                <div class="mail">
                    <div class="hedder_mail">
                        <?
                        $theme = mysqli_fetch_all(mysqli_query($connect, "SELECT `theme` FROM `homeworks` WHERE `id_homework` = '$idHomework'"))[0][0];
                        ?>
                        <input readonly maxlength="50" type="text" value="<?= $theme ?>">
                    </div>
                    <div class="textmail">
                        <?
                        $text = mysqli_fetch_all(mysqli_query($connect, "SELECT `textHomework` FROM `homeworks` WHERE `id_homework` = '$idHomework'"))[0][0];
                        ?>
                        <textarea readonly cols="30" rows="15" maxlength="300"><?= $text ?></textarea>
                    </div>
                    <div class="bottom">
                        <?
                        $deadlineOfHomework = mysqli_fetch_all(mysqli_query($connect, "SELECT `deadlineOfHomework` FROM `homeworks` WHERE `id_homework` = '$idHomework'"))[0][0];
                        if ($deadlineOfHomework == NULL)
                            echo '<div class="date_select hidden"></div>';
                        else {
                            echo '
                            <div class="date_select">
                            <span id="datetext">Выполнить до : ' . $deadlineOfHomework[8] . $deadlineOfHomework[9] . '.' . $deadlineOfHomework[5] . $deadlineOfHomework[6] . '.' . $deadlineOfHomework[0] . $deadlineOfHomework[1] . $deadlineOfHomework[2] . $deadlineOfHomework[3] . '</span>
                            <input readonly id="dateInput" type="date" name="deadline_of_work">
                        </div>';
                        }
                        ?>

                        <?
                        $document = mysqli_fetch_all(mysqli_query($connect, "SELECT `document` FROM `homeworks` WHERE `id_homework` = '$idHomework'"))[0][0];
                        if ($document == NULL)
                            echo '<div class="file_select hidden"></div>';
                        else {
                            echo '
                            <div class="file_select">
                            <div class="file_text">
                                <span id="filetext">Скачать файл</span>
                            </div>
                            <div class="file_icon_download"></div>

                            <a class = "input_photo" href ="homeworkDocuments/' . $document . '" download="' . $document . '">Скачать файл</a>
                            </div>';
                        }
                        ?>

                    </div>


                </div>
            </form>
            <div class="statusOfGroup hidden">
                <div class="statusGroupBar">
                    <span>Статистика по группе</span>
                </div>

                <?
                $countOfStudents = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `studients` WHERE `group_id` = '$groupId'"))[0][0];
                $arrOfStudents = mysqli_fetch_all(mysqli_query($connect, "SELECT * FROM `studients` WHERE `group_id` = '$groupId'"));
                print_r($arrOfStudents);
                
                for ($i = 0; $i < $countOfStudents; $i++) {
                    ?>
                    <div class="statusOfEverStudet">
                        <div class="nameOfStudent"><?=$arrOfStudents[$i][2] . ' '. $arrOfStudents[$i][3] . ' ' . $arrOfStudents[$i][4]?></div>
                        <div class="statusOfHomework"></div>
                        <div class="dateHomework"></div>
                        <div class="buttonViewHomework"></div>
                    </div>
                <?
                }
                ?>


            </div>

        </div>
    <?

    } else {

        ?>
        <div class="main_container">

            <form action="homeworkHandler.php" method="post" enctype="multipart/form-data">
                <div class="header">
                    <div class="destination_container">
                        <div class="left_container"><span>Группа :</span></div>
                        <div class="right_container">
                            <!-- Узнаем имя группы -->
                            <?
                            $groupId = $_SESSION['homework']['groupId'];
                            $groupName = mysqli_fetch_all(mysqli_query($connect, "SELECT `groups_name` FROM `groups` WHERE `groups_id` = $groupId"))[0][0]
                                ?>
                            <span>
                                <?= $groupName ?>
                            </span>
                        </div>
                        <input type="hidden" name="sender_id" value="<?= $_SESSION['dataOfUser']['userId'] ?>">
                        <input type="hidden" name="status" value='0'>
                        <input type="hidden" name="groupId" value='<?= $groupId ?>'>
                        <input type="hidden" name="subjectId" value='<?= $_SESSION['homework']['subjectId'] ?>'>

                    </div>
                    <div class="radio_container">
                        <div class="content_radio_container">
                            <input id="practice" id="1" type="radio" name="typeOfHomework" value="practice" checked>
                            <label>Практика</label>
                        </div>
                        <div class="content_radio_container">
                            <input id="abstract" type="radio" name="typeOfHomework" value="abstract">
                            <label>Конспект</label>
                        </div>
                    </div>
                    <div class="buttons">
                        <button type="submit" class="button_header">Отправить</button>
                        <button type="button" class="button_header exit"
                            onClick='location.href="../pa_teacher.php"'>Выйти</button>
                    </div>
                </div>

                <div class="mail">
                    <div class="hedder_mail">
                        <input maxlength="50" type="text" name="theme" placeholder="Напишите тему">
                    </div>
                    <div class="textmail">
                        <textarea name="text_homework" id="" cols="30" rows="15" maxlength="800"
                            placeholder="Ваш текст"></textarea>
                    </div>

                    <?
                    $date = date('d.m.y');
                    $time = date('H:i');
                    ?>
                    <input type="hidden" name="time" value="<?= $time ?>">
                    <input type="hidden" name="date" value="<?= $date ?>">

                    <div class="bottom">
                        <div class="date_select">
                            <span id="datetext">Выбрать дату выполнения</span>
                            <input id="dateInput" type="date" name="deadline_of_work">
                        </div>

                        <div class="file_select">
                            <div class="file_text">
                                <span id="filetext">Загрузить файл</span>
                            </div>
                            <div class="file_icon"></div>

                            <input class="input_photo" type="file" name="filename" size="10" />
                        </div>
                    </div>
                </div>


            </form>

        </div>
    <?

    }
    ?>

    <script src="../../js/homeworkCreate.js"></script>
</body>

</html>