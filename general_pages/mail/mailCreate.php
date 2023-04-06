<?
require_once '../../connection.php';
session_start();

if (isset($_POST['destination']) && isset($_POST['name'])) {
    $destination = $_POST['destination'];
    $name = $_POST['name'];

} else if (isset($_POST['destination_id']) && !empty($_POST['destination_id'])) {
    $destination_id = $_POST['destination_id'];
    $sender_id = $_POST['sender_id'];
    $status = $_POST['status'];
    $theme = $_POST['theme'];
    $text_letter = $_POST['text_letter'];

    mysqli_query($connect, "INSERT INTO `letters`(`sender_id`, `destination_id`, `status`, `theme`, `letter_text`) 
    VALUES ('$sender_id','$destination_id',' $status','$theme',' $text_letter')");
    header("Location: mail.php");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Почта</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/general_pages/mail/mailCreate.css">
</head>

<body>
    <?
    if (isset($_POST['action']) && $_POST['action'] == 'read') {
        $letterId = $_POST['letterId'];
        $theme = $_POST['theme'];
        $text = $_POST['text'];
        $senderId = $_POST['senderId'];
        $senderRole = mysqli_fetch_all(mysqli_query($connect, "SELECT `user_role` FROM `users` WHERE `user_id` = '$senderId'"))[0][0];
        if ($senderRole == 1) {
            $senderFullName = mysqli_fetch_all(mysqli_query($connect, "SELECT `first_name`, `last_name`, `surname`
            FROM `admins` WHERE `user_id` = '$senderId'"));
            $senderFullName = $senderFullName[0][1] . ' ' . $senderFullName[0][0] . ' ' . $senderFullName[0][2];


        }
        ?>
        <div class="main_container">
            <form action=" " method="post">
                <div class="header">
                    <div class="destination_container">
                        <div class="left_container"><span>Отправитель:</span></div>
                        <div class="right_container">
                            <span>
                                <?= $senderFullName ?>
                            </span>
                        </div>
                        <?
                        $destinationAnswer = $_POST['senderId'];
                        ?>
                        <input type="hidden" name="destinationAnser" value="<?= $destinationAnswer ?>">
                        <input type="hidden" name="sender_id" value="<?= $_SESSION['dataOfUser']['userId'] ?>">
                        <input type="hidden" name="status" value="notRead">

                    </div>

                    <div class="buttons">
                        <button type="submit" class="button_header">Ответить</button>
                        <button type="button" class="button_header exit" onClick='location.href="mail.php"'>К
                            письмам</button>
                    </div>
                </div>

                <div class="mail">
                    <div class="hedder_mail">
                        <input readonly maxlength="50" type="text" value="<?= $theme ?>">
                    </div>
                    <div class="textmail">
                        <textarea readonly cols="30" rows="15" maxlength="600"><?= $text ?></textarea>
                    </div>
                </div>
                <input type="hidden" name="action" value="answer">
            </form>
            <form action=" " method="post">
                <input hidden name="action" value="delete">
                <input hidden name="letterId" value="<?= $letterId ?>">
                <button type="submit" class="button_delete exit">Удалить это письмо</button>
            </form>
        </div>
    <?

    } else if (isset($_POST['action']) && $_POST['action'] == 'delete') {
        $letterId = $_POST['letterId'];
        mysqli_query($connect, "DELETE FROM `letters` WHERE `letter_id` = '$letterId'");
        header("Location:mail.php");
    } else if (isset($_POST['action']) && $_POST['action'] == 'answer') {

        $destination = $_POST['destinationAnser'];
        $userRole = $_SESSION['dataOfUser']['userRole'];
        if ($userRole == 1) {
            $fullName = mysqli_fetch_all(mysqli_query($connect, "SELECT `first_name`, `last_name`, `surname`
     FROM `admins` WHERE `user_id` = '$destination'"));
            $name = $fullName[0][1] . ' ' . $fullName[0][0] . ' ' . $fullName[0][2];

        } else if ($userRole == 2) {
            $fullName = mysqli_fetch_all(mysqli_query($connect, "SELECT `first_name`, `last_name`, `surname`
     FROM `teachers` WHERE `user_id` = '$destination'"));
            $name = $fullName[0][1] . ' ' . $fullName[0][0] . ' ' . $fullName[0][2];
        } else {
            $fullName = mysqli_fetch_all(mysqli_query($connect, "SELECT `first_name`, `last_name`, `surname`
     FROM `studients` WHERE `user_id` = '$destination'"));
            $name = $fullName[0][1] . ' ' . $fullName[0][0] . ' ' . $fullName[0][2];
        }



        ?>
                <div class="main_container">
                    <form action="" method="post">
                        <div class="header">
                            <div class="destination_container">
                                <div class="left_container"><span>Получатель:</span></div>
                                <div class="right_container">
                                    <span>
                                <?= $name ?>
                                    </span>
                                </div>
                                <input type="hidden" name="destination_id" value="<?= $destination ?>">
                                <input type="hidden" name="sender_id" value="<?= $_SESSION['dataOfUser']['userId'] ?>">
                                <input type="hidden" name="status" value="notRead">

                            </div>

                            <div class="buttons">
                                <button type="submit" class="button_header">Отправить</button>
                                <button type="button" class="button_header exit" onClick='location.href="mail.php"'>К
                                    письмам</button>
                            </div>
                        </div>

                        <div class="mail">
                            <div class="hedder_mail">
                                <input maxlength="50" type="text" name="theme" placeholder="Напишите тему письма">
                            </div>
                            <div class="textmail">
                                <textarea name="text_letter" id="" cols="30" rows="15" maxlength="600"
                                    placeholder="Ваше сообщение"></textarea>
                            </div>
                        </div>
                    </form>

                </div>
    <?
    } else {
        ?>

                <div class="main_container">
                    <form action="" method="post">
                        <div class="header">
                            <div class="destination_container">
                                <div class="left_container"><span>Получатель:</span></div>
                                <div class="right_container">
                                    <span>
                                <?= $name ?>
                                    </span>
                                </div>
                                <input type="hidden" name="destination_id" value="<?= $destination ?>">
                                <input type="hidden" name="sender_id" value="<?= $_SESSION['dataOfUser']['userId'] ?>">
                                <input type="hidden" name="status" value="notRead">

                            </div>

                            <div class="buttons">
                                <button type="submit" class="button_header">Отправить</button>
                                <button type="button" class="button_header exit" onClick='location.href="mail.php"'>К
                                    письмам</button>
                            </div>
                        </div>

                        <div class="mail">
                            <div class="hedder_mail">
                                <input maxlength="50" type="text" name="theme" placeholder="Напишите тему письма">
                            </div>
                            <div class="textmail">
                                <textarea name="text_letter" id="" cols="30" rows="15" maxlength="600"
                                    placeholder="Ваше сообщение"></textarea>
                            </div>
                        </div>
                    </form>

                </div>
    <?

    }
    ?>


</body>

</html>