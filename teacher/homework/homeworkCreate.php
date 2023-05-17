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
        $letterId = $_POST['letterId'];
        $theme = $_POST['theme'];
        $text = $_POST['text'];
        $senderId = $_POST['senderId'];
        $senderRole = mysqli_fetch_all(mysqli_query($connect, "SELECT `user_role` FROM `users` WHERE `user_id` = '$senderId'"))[0][0];
        if ($senderRole == 1) {
            $senderFullName = mysqli_fetch_all(mysqli_query($connect, "SELECT `first_name`, `last_name`, `surname`
            FROM `admins` WHERE `user_id` = '$senderId'"));
            $senderFullName = $senderFullName[0][1] . ' ' . $senderFullName[0][0] . ' ' . $senderFullName[0][2];


        } else if ($senderRole == 2) {
            $senderFullName = mysqli_fetch_all(mysqli_query($connect, "SELECT `first_name`, `last_name`, `surname`
            FROM `teachers` WHERE `user_id` = '$senderId'"));
            $senderFullName = $senderFullName[0][1] . ' ' . $senderFullName[0][0] . ' ' . $senderFullName[0][2];


        } else {
            $senderFullName = mysqli_fetch_all(mysqli_query($connect, "SELECT `first_name`, `last_name`, `surname`
            FROM `studients` WHERE `user_id` = '$senderId'"));
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
                                группа
                            </span>
                        </div>
                        <?
                        $destinationAnswer = $_POST['senderId'];
                        ?>
                        <input type="hidden" name="destinationAnser" value="<?= $destinationAnswer ?>">
                        <input type="hidden" name="sender_id" value="<?= $_SESSION['dataOfUser']['userId'] ?>">
                        <input type="hidden" name="status" value='0'>

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
                        <textarea readonly cols="30" rows="15" maxlength="300"><?= $text ?></textarea>
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

    } else if (isset($_POST['action']) && $_POST['action'] == 'answer') { // СКОРЕЕ ВСЕГО ДЛЯ ПРЕПОДА ЭТО НЕ НУЖНО !!!

        $destination = $_POST['destinationAnser'];
        $userRole = mysqli_fetch_all(mysqli_query($connect, "SELECT `user_role` FROM `users` WHERE `user_id` = '$destination'"))[0][0];
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

                                </span>
                            </div>
                            <input type="hidden" name="destination_id" value="">
                            <input type="hidden" name="sender_id" value="<?= $_SESSION['dataOfUser']['userId'] ?>">
                            <input type="hidden" name="status" value="0">

                        </div>

                        <div class="buttons">
                            <button type="submit" class="button_header">Отправить</button>
                            <button type="button" class="button_header exit" onClick='location.href="mail.php"'>В личный
                                кабинет</button>
                        </div>
                    </div>

                    <div class="mail">
                        <div class="hedder_mail">
                            <input maxlength="50" type="text" name="theme" placeholder="Напишите тему">
                        </div>
                        <div class="textmail">
                            <textarea name="text_homework" id="" cols="30" rows="15" maxlength="600"
                                placeholder="Ваш текст"></textarea>
                        </div>
                    </div>

                <?
                $date = date('d.m.y');
                $time = date('H:i');
                ?>
                    <input type="hidden" name="time" value="<?= $time ?>">
                    <input type="hidden" name="date" value="<?= $date ?>">

                </form>

            </div>
    <?
        // Создание
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
                            <input type="hidden" name="groupId" value='<?=$groupId?>'>
                            <input type="hidden" name="subjectId" value='<?=$_SESSION['homework']['subjectId']?>'>

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

                                <input class="input_photo" type="file" name="filename" size="10"/>
                            </div>
                        </div>
                    </div>


                </form>

            </div>
    <?

    }
    ?>

    <script src = "../../js/homeworkCreate.js"></script>
</body>

</html>