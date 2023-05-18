<?
require_once '../../connection.php';
session_start();
header('Refresh: 10');

$userId = $_SESSION['dataOfUser']['userId'];
$studentId = mysqli_fetch_all(mysqli_query($connect, "SELECT `studient_id` FROM `studients` WHERE `user_id` = '$userId'"))[0][0];
$groupId = mysqli_fetch_all(mysqli_query($connect, "SELECT `group_id` FROM `studients` WHERE `user_id` = '$userId'"))[0][0];
if (isset($_POST['subjectId']) and !empty($_POST['subjectId'])) {
    $_SESSION['subjectId'] = $_POST['subjectId'];

}

$subjectId = $_SESSION['subjectId'];



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Почта</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/teacher/homeworkHub.css">
</head>

<body>
    <div class="main_container">
        <div class="header">
            <div class="all_mail">
                <label>Все работы</label>
            </div>

            <div class="buttons">
                <? $checkUserRole = $_SESSION['dataOfUser']['userRole']; ?>
                <button class="button_header exit" onClick='location.href="../pa_student.php"'>Выйти</button>
            </div>
        </div>
        <div class="letter_box">
            <?

            $countOfHomework = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `homeworks` WHERE `groupId` = '$groupId' AND `subjectId` = '$subjectId'"))[0][0];
            $homeworks = mysqli_fetch_all(mysqli_query($connect, "SELECT * FROM `homeworks`  WHERE `groupId` = '$groupId' AND `subjectId` = '$subjectId'"));

            if ($countOfHomework == 0) {
                ?>
                <div class="warning">
                    <div class="warning_content">
                        <div class="warning_img">
                            <img src="/img/general_pages/mail/mail_box.png" class="icon2">
                        </div>
                        <div class="warning_text">
                            <span>У этой группы пока нет никаких работ</span>
                        </div>
                    </div>
                </div>
            <?
            } else {
                for ($i = 0; $i < $countOfHomework; $i++) {

                    $idHomework = $homeworks[$i][0];
                    $typeOfHomework = $homeworks[$i][4];
                    $theme = $homeworks[$i][5];
                    $time = $homeworks[$i][7];
                    $date = $homeworks[$i][8];


                    if ($date == date('d.m.y'))
                        $dateTime = $time;
                    else
                        $dateTime = $date;

                    if ($typeOfHomework == 'abstract') {
                        $homeworkIcon = '<div class = "letter_close">';
                        $typeOfHomework = 'Конспект';
                    } else {
                        $homeworkIcon = '<div class = "letter_open">';
                        $typeOfHomework = 'Практика';
                    }
                    echo '
                <form action = "homeworkRead.php" method = "post">
                <input type = "hidden" name = "idHomework" value = "' . $idHomework . '">
                <input type = "submit" class = "inputSubmit">
                <div class="letter">
                <div class="icon">
                ' . $homeworkIcon . '
                </div>
                </div>
                <div class="typeOfHomework"><span>' . $typeOfHomework . '</span></div>
                <div class="theme"><span>' . $theme . '</span></div>
                <div class="date"><span>' . $dateTime . '</span></div>
            </div>
                
                </form>';

                }
            }
            ?>

        </div>
    </div>
    <script> // чтобы не переделывать css и не писать новых файлов :)
        document.querySelector('.buttons').style.justifyContent = 'end';
    </script>

</body>

</html>