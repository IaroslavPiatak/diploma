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
    <link rel="stylesheet" href="../../css/student/homeworkRead.css">
</head>

<body>
    <?

    $idHomework = $_POST['idHomework'];
    $subjectId = $_SESSION['subjectId'];
    $subjectName = mysqli_fetch_all(mysqli_query($connect, "SELECT `subjects_name` FROM `subjects` WHERE `subjects_id` = '$subjectId'"))[0][0];
    ?>
    <div class="main_container">
        <form action="homeworkAnswer.php" method="post">
            <div class="header">
                <div class="destination_container">
                    <div class="left_container"><span>Предмет :</span></div>
                    <div class="right_container">
                        <span id="subjectName">
                            <?= $subjectName ?>
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
                            <input readonly id="dateInput" type="date">
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

                            <a class = "input_photo" href ="../../teacher/homework/homeworkDocuments/' . $document . '" download="' . $document . '">Скачать файл</a>
                            </div>';
                    }
                    ?>

                </div>
                <?
                if($typeOfHomework != 'abstract')
                echo'  <button class="buttonAnswer">Выполнить практику</button>';
                ?>
              


            </div>
            <input type="hidden" name = 'idHomework'value = '<?=$idHomework?>'>
        </form>
    </div>
    <script src="../../js/homeworkRead.js"></script>

</body>

</html> 