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
        <form action="homeworkHandler.php" method="post"  enctype="multipart/form-data">
            <div class="header">
                <div class="destination_container">
                    <div class="left_container"><span>Предмет :</span></div>
                    <div class="right_container">
                        <span id="subjectName">
                            <?= $subjectName ?>
                        </span>
                    </div>
                </div>
                <button type="submit" class="button_header">Отправить</button>
                <button type="button" class="button_header exit"
                    onClick='location.href="homeworkHub.php"'>Назад</button>

            </div>

            <div class="mail">
                <div class="textmail">
                    <textarea placeholder="Начните писать тут" cols="30" rows="15" maxlength="300" name = "text"></textarea>
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

                    <div class="file_select">
                        <div class="file_text">
                            <span id="filetext">Загрузить файл</span>
                        </div>
                        <div class="file_icon"></div>

                        <input class="input_photo" type="file" name="filename" size="10" />
                    </div>

                </div>
            </div>
            <input type="hidden" name='idHomework' value='<?= $idHomework ?>'>
            <?
            $date = date('d.m.y');
            $time = date('H:i');
            ?>
            <input type="hidden" name="time" value="<?= $time ?>">
            <input type="hidden" name="date" value="<?= $date ?>">
            ?>
        </form>
    </div>
    <script>
        const filetext = document.getElementById('filetext');
        const fileicon = document.querySelector('.file_icon');
        const fileinput = document.querySelector('.input_photo');
        document.querySelector('.destination_container').style.width = '650px';
        document.querySelector('.right_container').style.width = '500px';
        fileinput.addEventListener("input", (event) => {
            filetext.innerHTML = `<span>Файл загружен</span>`;
            fileicon.style.backgroundImage = "url(../../img/teacher/homework/file_ready.png)";
        });


    </script>

</body>

</html>