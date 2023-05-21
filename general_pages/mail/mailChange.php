<?
require_once '../../connection.php';
session_start();
$userRole = $_SESSION['dataOfUser']['userRole'];
echo '<span hidden id = "outputContent">admin</span>';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Выбор получателя</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/general_pages/mail/mailChange.css">
</head>

<body>

    <main>

        <div class="main_container">

            <div class="main_container_header">
                <div class="input_container_admin">
                    <label id="labelAdmin">Администраторы</label>
                    <input id="inputAdmin" type="radio" name="userRole" value="admin" checked>
                </div>

                <div class="input_container_teacher">
                    <label id="labelTeacher">Преподаватели</label>
                    <input id="inputTeacher" type="radio" name="userRole" value="teacher">

                </div>


                <div class="input_container_student">
                    <label id="labelStudent">Студенты</label>
                    <input id="inputStudent" type="radio" name="userRole" value="student">
                </div>

                <div class="exit_btn_container">
                    <button type="button" class="exit_btn" onClick='location.href="mail.php"'>Вернуться к письмам
                    </button>
                </div>
            </div>

            <div class="admins_output">
                <?
                $countOfAdmins = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `admins`"))[0][0];
                if (($countOfAdmins == 0) || ($countOfAdmins == 1 && $userRole == 1)) {
                    ?>
                    <div class="warning">
                            <div class="warning_content">
                                <div class="warning_img">
                                    <img src="/img/general_pages/mail/ufo.png" class="icon2">
                                </div>
                                <div class="warning_text">
                                    <span>Кажется, тут никого нет...</span>
                                </div>
                            </div>
                        </div>
                    <?
                } 
                else 
                {
                    $userIdMass = mysqli_fetch_all(mysqli_query($connect, "SELECT `user_id` FROM `admins`"));
                    for ($i = 0; $i < $countOfAdmins; $i++) {
                        $userId = $userIdMass[$i][0];
                        if ($userId == $_SESSION['dataOfUser']['userId']) {
                            continue;
                        }
                        ?>

                        <form method="post" action="mailCreate.php">
                            <div class="profile_card">
                                <div class="profile_card_content">
                                    <div class="profile_card_img">
                                        <?php



                                        echo '<input type = "hidden" name="destination" value = "' . $userId . '">';

                                        $check_photo = mysqli_fetch_all(mysqli_query($connect, "SELECT `photo` FROM `admins` WHERE `user_id` = '$userId'"))[0][0];



                                        if ($check_photo === NULL) {
                                            echo '<img src="../../../img/admin/avatar.png" class="avatar">';
                                        } else {
                                            $path = '../../../img/admin/avatars/' . $check_photo;
                                            $path = str_replace(' ', '', $path);
                                            echo '<img class = "avatarChange" src="' . $path . '">';

                                        }
                                        ?>

                                    </div>
                                    <div class="name">
                                        <?php
                                        $userFullName = mysqli_fetch_all(mysqli_query($connect, "SELECT `first_name`, `last_name`, `surname`
                            FROM `admins` WHERE `user_id` = '$userId'"));
                                        echo '<span>' . $userFullName[0][1] . ' ' . $userFullName[0][0] . ' ' . $userFullName[0][2] . '</span>';
                                        echo '<input type = "hidden" name="name" value = "' . $userFullName[0][1] . ' ' . $userFullName[0][0] . ' ' . $userFullName[0][2] . '">';
                                        ?>
                                    </div>
                                    <div class="email">
                                        <?php
                                        $userEmail = mysqli_fetch_all(mysqli_query($connect, "SELECT email FROM `admins` WHERE `user_id` = '$userId'"))[0][0];
                                        echo '<span>' . $userEmail . '</span>';
                                        ?>

                                    </div>

                                </div>
                                <input type="hidden" name = "action"value ="create">        
                                <input class="btn-submit" type="submit">
                            </div>

                        </form>
                    <?
                    }
                }
                ?>
            </div>


            <!-- Вывод преподов -->

            <div class="teachers_output">
                <?
                $countOfTeachers = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `teachers`"))[0][0];
                if (($countOfTeachers == 0) || ($countOfTeachers == 1 && $userRole == 2)) {
                    ?>
                    <div class="warning">
                            <div class="warning_content">
                                <div class="warning_img">
                                    <img src="/img/general_pages/mail/ufo.png" class="icon2">
                                </div>
                                <div class="warning_text">
                                    <span>Кажется, тут никого нет...</span>
                                </div>
                            </div>
                        </div>
                    <?
                } 
                else 
                {
                    $userIdMass = mysqli_fetch_all(mysqli_query($connect, "SELECT `user_id` FROM `teachers`"));
                    for ($i = 0; $i < $countOfTeachers; $i++) {
                        $userId = $userIdMass[$i][0];
                        if ($userId == $_SESSION['dataOfUser']['userId']) {
                            continue;
                        }
                        ?>

                        <form method="post" action="mailCreate.php">
                            <div class="profile_card">
                                <div class="profile_card_content">
                                    <div class="profile_card_img">
                                        <?php



                                        echo '<input type = "hidden" name="destination" value = "' . $userId . '">';

                                        $check_photo = mysqli_fetch_all(mysqli_query($connect, "SELECT `photo` FROM `teachers` WHERE `user_id` = '$userId'"))[0][0];



                                        if ($check_photo === NULL) {
                                            echo '<img src="../../../img/teacher/avatar.png" class="avatar">';
                                        } else {
                                            $path = '../../../img/teacher/avatars/' . $check_photo;
                                            $path = str_replace(' ', '', $path);
                                            echo '<img class = "avatarChange" src="' . $path . '">';

                                        }
                                        ?>

                                    </div>
                                    <div class="name">
                                        <?php
                                        $userFullName = mysqli_fetch_all(mysqli_query($connect, "SELECT `first_name`, `last_name`, `surname`
                            FROM `teachers` WHERE `user_id` = '$userId'"));
                                        echo '<span>' . $userFullName[0][1] . ' ' . $userFullName[0][0] . ' ' . $userFullName[0][2] . '</span>';
                                        echo '<input type = "hidden" name="name" value = "' . $userFullName[0][1] . ' ' . $userFullName[0][0] . ' ' . $userFullName[0][2] . '">';
                                        ?>
                                    </div>
                                    <div class="email">
                                        <?php
                                        $userEmail = mysqli_fetch_all(mysqli_query($connect, "SELECT email FROM `teachers` WHERE `user_id` = '$userId'"))[0][0];
                                        echo '<span>' . $userEmail . '</span>';
                                        ?>

                                    </div>

                                </div>
                                <input type="hidden" name = "action"value ="create">
                                <input class="btn-submit" type="submit">
                            </div>

                        </form>
                    <?
                    }
                }
                ?>
            </div>


             <!-- Вывод студентов -->

             <div class="studients_output">
                <?
                $countOfStudients = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `studients`"))[0][0];
                if (($countOfStudients == 0) || ($countOfStudients == 1 && $userRole == 2)) {
                    ?>
                    <div class="warning">
                            <div class="warning_content">
                                <div class="warning_img">
                                    <img src="/img/general_pages/mail/ufo.png" class="icon2">
                                </div>
                                <div class="warning_text">
                                    <span>Кажется, тут никого нет...</span>
                                </div>
                            </div>
                        </div>
                    <?
                } 
                else 
                {
                    $userIdMass = mysqli_fetch_all(mysqli_query($connect, "SELECT `user_id` FROM `studients`"));
                    for ($i = 0; $i < $countOfStudients; $i++) {
                        $userId = $userIdMass[$i][0];
                        if ($userId == $_SESSION['dataOfUser']['userId']) {
                            continue;
                        }
                        ?>

                        <form method="post" action="mailCreate.php">
                            <div class="profile_card">
                                <div class="profile_card_content">
                                    <div class="profile_card_img">
                                        <?php



                                        echo '<input type = "hidden" name="destination" value = "' . $userId . '">';

                                        $check_photo = mysqli_fetch_all(mysqli_query($connect, "SELECT `photo` FROM `studients` WHERE `user_id` = '$userId'"))[0][0];



                                        if ($check_photo === NULL) {
                                            echo '<img src="../../../img/student/avatar.png" class="avatar">';
                                        } else {
                                            $path = '../../../img/student/avatars/' . $check_photo;
                                            $path = str_replace(' ', '', $path);
                                            echo '<img class = "avatarChange" src="' . $path . '">';

                                        }
                                        ?>

                                    </div>
                                    <div class="name">
                                        <?php
                                        $userFullName = mysqli_fetch_all(mysqli_query($connect, "SELECT `first_name`, `last_name`, `surname`
                            FROM `studients` WHERE `user_id` = '$userId'"));
                                        echo '<span>' . $userFullName[0][1] . ' ' . $userFullName[0][0] . ' ' . $userFullName[0][2] . '</span>';
                                        echo '<input type = "hidden" name="name" value = "' . $userFullName[0][1] . ' ' . $userFullName[0][0] . ' ' . $userFullName[0][2] . '">';
                                        ?>
                                    </div>
                                    <div class="email">
                                        <?php
                                        $userEmail = mysqli_fetch_all(mysqli_query($connect, "SELECT email FROM `studients` WHERE `user_id` = '$userId'"))[0][0];
                                        echo '<span>' . $userEmail . '</span>';
                                        ?>

                                    </div>

                                </div>
                                <input type="hidden" name = "action"value ="create">
                                <input class="btn-submit" type="submit">
                            </div>

                        </form>
                    <?
                    }
                }
                ?>
            </div>

        </div>


    </main>




    <script src="../../js/mailChange.js"></script>

</body>

</html>