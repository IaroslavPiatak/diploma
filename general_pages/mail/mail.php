<?
require_once '../../connection.php';
session_start();
header('Refresh: 10');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Почта</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/general_pages/mail/mail.css">
</head>

<body>
    <div class="main_container">
        <div class="header">
            <div class="all_mail">
                <label>Все письма</label>
                <!-- <input id="inputAdmin" type="radio" name="userRole" value="admin"> -->
            </div>

            <div class="buttons">
                <button class="button_header" onClick='location.href="mailChange.php"'>Написать</button>
                <?
                $checkUserRole = $_SESSION['dataOfUser']['userRole'];
                if($checkUserRole == 1)
                {
                    ?>
                    <button class="button_header exit" onClick='location.href="../../admin/paAdmin.php"'>Выйти</button>
                    <?

                }
                else if($checkUserRole == 2)
                {
                    ?>
                    <button class="button_header exit" onClick='location.href="../../teacher/pa_teacher.php"'>Выйти</button>
                    <?

                }
                else
                {
                    ?>
                    <button class="button_header exit" onClick='location.href="../../student/pa_student.php"'>Выйти</button>
                    <?

                }
                
                ?>
               
            </div>
        </div>
        <div class="letter_box">
            <?
            $userId = $_SESSION['dataOfUser']['userId'];
          
            $countOfLetter = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `letters` WHERE `destination_id` = '$userId'"))[0][0];
            $letters = mysqli_fetch_all(mysqli_query($connect, "SELECT * FROM `letters` WHERE `destination_id` = '$userId'"));
          
            if ($countOfLetter == 0) {
                ?>
                <div class="warning">
                            <div class="warning_content">
                                <div class="warning_img">
                                    <img src="/img/general_pages/mail/mail_box.png" class="icon2">
                                </div>
                                <div class="warning_text">
                                    <span>Ваш почтовый ящик пуст</span>
                                </div>
                            </div>
                        </div>
                <?
            } else {
                for ($i = 0; $i < $countOfLetter; $i++) {
                    $letterId = $letters[$i][0];
                    $senderId = $letters[$i][1];
                    $letterStatus = $letters[$i][3];
                    $theme = $letters[$i][4];
                    $text = $letters[$i][5];
                    $date = $letters[$i][6];
                    $time = $letters[$i][7];

                    if($date == date('d.m.y'))
                    $dateTime = $time;
                    else
                    $dateTime = $date;

                    if($letterStatus == 0)
                    $letterIcon = '<div class = "letter_close">';
                    else
                    $letterIcon = '<div class = "letter_open">';

                   
                   
                    echo '
                <form action = "mailCreate.php" method = "post">
                <input type = "hidden" name = "letterId" value = "' . $letterId . '">
                <input type = "hidden" name = "senderId" value = "' . $senderId . '">
                <input type = "hidden" name = "theme" value = "' . $theme . '">
                <input type = "hidden" name = "text" value = "' . $text . '">
                <input type = "hidden" name = "action" value = "read">
                <input type = "submit" class = "inputSubmit">
                <div class="letter">
                <div class="icon">
                '.$letterIcon.'
                </div>
                </div>
                <div class="theme"><span>' . $theme . '</span></div>
                <div class="date"><span>' . $dateTime . '</span></div>
            </div>
                
                </form>';

                }
            }
            ?>

        </div>
    </div>

</body>

</html>