<!-- Made by Iaroslav Piatak -->
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
    <title>Регистрация</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/admin/registration/registration.css">
</head>

<body>
    <main>
        <?
        if (!empty($_SESSION['student'])) {
            $lastName = $_SESSION['student']['lastName'];
            $name = $_SESSION['student']['name'];
            $surname = $_SESSION['student']['surname'];
            $email = $_SESSION['student']['email'];
            $login = $_SESSION['student']['lastName'];
            $password = $_SESSION['student']['password'];
            $facultyId = $_SESSION['student']['facultyId'];

            $countGroups = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `groups`
            WHERE `faculty_id` = '$facultyId'"))[0][0];
            ?>
            <form class="main_container" action="registrationHandler.php" method="post"> <!--Форма отправлки-->
                <span class="hidden" id="userRole">student</span>
                <!--Отвечает за динамическое отображение верхнего меню выбора-->
                <div class="main_container_header">
                    <div class="input_container_admin">
                        <!--Выбор роли пользователя сделан с костылями, необходимо когда-нибудь исправить-->
                        <label id="labelAdmin" class="clickInput">Администратор</label>
                        <input id="inputAdmin" type="radio" name="userRole" value="admin" checked>
                    </div>

                    <div class="input_container_teacher">
                        <label id="labelTeacher">Преподаватель</label>
                        <input id="inputTeacher" type="radio" name="userRole" value="teacher" checked>

                    </div>


                    <div class="input_container_student">
                        <label id="labelStudent">Студент</label>
                        <input id="inputStudent" type="radio" name="userRole" value="student" checked>

                    </div>

                    <div class="exit_btn_container">
                        <button type="button" class="exit_btn" onClick='location.href="registrationOut.php"'>Вернуться в
                            личный
                            кабинет</button>
                    </div>

                </div>

                <div class="input_block"> <!--Блок с вводом данных о пользователе-->
                    <input class="input_data" type="text" placeholder="Введите Фамилию" name="lastName"
                        value="<?= $lastName ?>">
                    <input class="input_data" type="text" placeholder="Введите Имя" name="name" value="<?= $name ?>">
                    <input class="input_data" type="text" placeholder="Введите Отчество" name="surname"
                        value="<?= $surname ?>">
                    <input class="input_data" type="text" placeholder="Введите Email" name="email" value="<?= $email ?>">
                    <input class="input_data" type="text" placeholder="Введите Логин" name="login" value="<?= $login ?>">
                    <input class="input_data" type="text" placeholder="Введите Пароль" name="password"
                        value="<?= $password ?>">

                </div>

                <div class="title_list">
                    <span>Выберите группу</span>
                </div>
                <!-- Вывод групп для студентов -->
                <div class="list_output_student_groups">
                    <?
                    if ($countGroups == 0) {
                        echo 'Групп у этого факультета нет !!!';
                    } else {
                        $arrayOfGroups = mysqli_fetch_all(
                            mysqli_query(
                                $connect,
                                "SELECT `groups_name` FROM `groups` WHERE `faculty_id` = '$facultyId'"
                            )
                        ); // получаем id первой группы
                        $nextGroup = 0;


                        for ($i = 0; $i < $countGroups; $i++) {

                            echo ' <div class="faculty">
                        <div class="faculty_content">
                            <div class="faculty_text">
                                <span>' . $arrayOfGroups[$nextGroup][0] . '</span>
                                
                            </div>
                        </div>
                        <input type = "radio" class = "btn_form"  name = "groupId" value = "' . $nextGroup . '">
                    </div>';
                            $nextGroup++; // увеличиваем id первого элемента, т.е. получаем id 2 элемента
                
                        }
                        ?>
                        <div class="faculty_content_button">
                            <div class="faculty_text_button">
                                <span>Далее</span>
                            </div>
                            <button type="submit" id="btn_form_faculties_next" class="btn_form"></button>
                            <input type="hidden" name="type_form" value="studentGroups">
                        </div>
                    <?
                    }
                    ?>
                </div>


            </form>
        <?
        } else {
            ?>
            <form class="main_container" action="registrationHandler.php" method="post">

                <div class="main_container_header">
                    <div class="input_container_admin">
                        <label id="labelAdmin" class="clickInput">Администратор</label>
                        <input id="inputAdmin" type="radio" name="userRole" value="admin" checked>
                    </div>

                    <div class="input_container_teacher">
                        <label id="labelTeacher">Преподаватель</label>
                        <input id="inputTeacher" type="radio" name="userRole" value="teacher" checked>

                    </div>


                    <div class="input_container_student">
                        <label id="labelStudent">Студент</label>
                        <input id="inputStudent" type="radio" name="userRole" value="student" checked>

                    </div>

                    <div class="exit_btn_container">
                        <button type="button" class="exit_btn" onClick='location.href="registrationOut.php"'>Вернуться в
                            личный
                            кабинет</button>
                    </div>

                </div>

                <div class="input_block">
                    <input class="input_data" type="text" placeholder="Введите Фамилию" name="lastName">
                    <input class="input_data" type="text" placeholder="Введите Имя" name="name">
                    <input class="input_data" type="text" placeholder="Введите Отчество" name="surname">
                    <input class="input_data" type="text" placeholder="Введите Email" name="email">
                    <input class="input_data" type="text" placeholder="Введите Логин" name="login">
                    <input class="input_data" type="text" placeholder="Введите Пароль" name="password">

                </div>

                <div class="title_list">
                    <span>Выберите факультет</span>
                </div>

                <div class="list_output_student_faculties hidden">
                    <?php
                    $countOfFaculty = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `faculties`"))[0][0];
                    if ($countOfFaculty == 0) {
                        echo 'Факультетов нет';
                    } else {
                        $firstFacultyId = mysqli_fetch_all(
                            mysqli_query(
                                $connect,
                                "SELECT `faculty_id` FROM `faculties` LIMIT 1"
                            )
                        )[0][0];
                        for ($i = 0; $i < $countOfFaculty; $i++) {
                            echo '
                            <div class="faculty_content">
                            <input type = "radio" class = "btn_form"  name = "facultyId" value = "' . $firstFacultyId . '">
                                <div class="faculty_text">
                                    <span>'
                                . $facultyName = mysqli_fetch_all(
                                    mysqli_query(
                                        $connect,
                                        "SELECT `faculty_name` FROM `faculties` 
                                    WHERE `faculty_id` = '$firstFacultyId'"
                                    )
                                )[0][0] . // вытаскиваем имя факультета, по id первого факультета
                                '</span>
                                    
                                </div>
                               
                            </div>';
                            $firstFacultyId++; // увеличиваем id первого элемента, т.е. получаем id 2 элемента
                
                        }
                    }

                    ?>
                    <div class="faculty_content_button">
                        <div class="faculty_text_button">
                            <span>Далее</span>
                        </div>
                        <button type="submit" id="btn_form_faculties_next" class="btn_form"></button>
                        <input type="hidden" name="type_form" value="studentFaculties">

                    </div>
                </div>
            </form>
        <?
        }
        ?>
    </main>

    <script src="../../js/registration.js"></script>

</body>

</html>