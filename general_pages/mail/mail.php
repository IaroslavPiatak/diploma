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
                <button class="button_header exit" onClick='location.href="../../admin/paAdmin.php"'>Выйти</button>
            </div>
        </div>
        <div class="letter_box">
            <?
            $userId = $_SESSION['dataOfUser']['userId'];
            $countOfLetter = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `letters` WHERE `destination_id` = '$userId'"))[0][0];
            $letters = mysqli_fetch_all(mysqli_query($connect, "SELECT * FROM `letters` WHERE `destination_id` = '$userId'"));
            if ($countOfLetter == 0) {
                echo 'писем нет !!!';
            } else {
                for ($i = 0; $i < $countOfLetter; $i++) {
                    $letterId = $letters[$i][0];
                    $senderId = $letters[$i][1];
                    $theme = $letters[$i][4];
                    $text = $letters[$i][5];
                    echo '
                <form action = "mailCreate.php" method = "post">
                <input type = "hidden" name = "letterId" value = "' . $letterId . '">
                <input type = "hidden" name = "senderId" value = "' . $senderId . '">
                <input type = "hidden" name = "theme" value = "' . $theme . '">
                <input type = "hidden" name = "text" value = "' . $text . '">
                <input type = "hidden" name = "action" value = "read">
                <input type = "submit" class = "inputSubmit">
                <div class="letter">
                <div class="icon"><div class="letter_open"></div>
                </div>
                <div class="theme"><span>' . $theme . '</span></div>
                <div class="date"><span>10:36</span></div>
            </div>
                
                </form>';

                }
            }
            ?>

        </div>
    </div>

</body>

</html>