<?
require_once '../../connection.php';
$idAnswer = $_POST['idAnswer'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Домашка</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/teacher/homeworkViewAnswer.css">
</head>

<body>
    <div class="main_container">

        <form action="homeworkHandler.php" method="post" enctype="multipart/form-data">
            <div class="header">
                <div class="destination_container">
                    <div class="left_container"><span>Группа :</span></div>
                    <div class="right_container">
                        <!-- Узнаем имя группы -->
                        <?
                        $groupId = mysqli_fetch_all(mysqli_query($connect, "SELECT `groupId` FROM `answers` WHERE `answerId` = '$idAnswer'"))[0][0];
                        $groupName = mysqli_fetch_all(mysqli_query($connect, "SELECT `groups_name` FROM `groups` WHERE `groups_id` = $groupId"))[0][0]
                            ?>
                        <span>
                            <?= $groupName ?>
                        </span>
                    </div>


                </div>
                <div class="buttons">
                    <button type="submit" class="button_header">Открыть журнал</button>
                    <button type="button" class="button_header exit"
                        onClick='location.href="homeworkHub.php"'>Назад</button>
                </div>
            </div>

            <div class="mail">
                <div class="textmail">
                    <?
                    $text = mysqli_fetch_all(mysqli_query($connect, "SELECT `text` FROM `answers` WHERE `answerId` = '$idAnswer'"))[0][0];
                    ?>
                    <textarea readonly name="text_homework" id="" cols="30" rows="15"
                        maxlength="800"><?= $text ?></textarea>
                </div>

                <div class="bottom">
                    <div class="date_select">
                        <?
                        $date = mysqli_fetch_all(mysqli_query($connect, "SELECT `date` FROM `answers` WHERE `answerId` = '$idAnswer'"))[0][0];
                        ?>
                        <span>Сдал
                            <?= $date ?>
                        </span>
                    </div>

                    <div class="file_select">
                        <?
                        $document = mysqli_fetch_all(mysqli_query($connect, "SELECT `document` FROM `answers` WHERE `answerId` = '$idAnswer'"))[0][0]; 
                        echo '
                        <div class="file_select">
                        <div class="file_text">
                            <span id="filetext">Скачать файл</span>
                        </div>
                        <div class="file_icon_download"></div>

                        <a class = "input_photo" href ="homeworkDocuments/' . $document . '" download="' . $document . '">Скачать файл</a>
                        </div>';
                        ?>
                    </div>
                </div>
            </div>


        </form>

    </div>
</body>

</html>