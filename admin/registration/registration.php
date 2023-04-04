<!-- Made by Iaroslav Piatak -->
<?
require_once '../../connection.php';
session_start();


// проверка на финальную страницу регистрации
if (isset($_SESSION['studentWithFaculty']['studentFinal']) && $_SESSION['studentWithFaculty']['studentFinal'] == 'true') {
    $finalPage = 'student';


} elseif (isset($_SESSION['teacher']['teacherFinal']) && $_SESSION['teacher']['teacherFinal'] == 'true') {
    $finalPage = 'teacher';
} else
    $finalPage = 'none';
// проверка на роль страничеи
if (isset($_SESSION['studentWithFaculty']) and !empty($_SESSION['studentWithFaculty'])) {
    $userRole = 'studentGroup';
    $groupOutput = 'true';
} else if (isset($_SESSION['teacher']) and !empty($_SESSION['teacher'])) {
    $userRole = 'teacher';
} else {
    $userRole = 'admin'; // переменная определяющая какой пункт меню в header будет выделен изначально
    $groupOutput = 'false';
}
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
        <!-- В другом положении span НЕ РАБОТАЕТ !!!!    
        <span class="hidden" id="userRole"><?= $userRole ?></span>
        <span class="hidden" id="groupOutput"><?= $groupOutput ?></span>
        <span class="hidden" id="finalPage"><?= $finalPage ?></span> -->
        <span class="hidden" id="userRole"><?= $userRole ?></span>
        <span class="hidden" id="groupOutput"><?= $groupOutput ?></span>
        <span class="hidden" id="finalPage"><?= $finalPage ?></span>

        <form class="main_container" action="registrationHandler.php" method="post">

            <div class="main_container_header">
                <?
                if ($finalPage == 'student') {
                    ?>
                    <div class="final_header_container">
                        <span>Студент</span>
                    </div>
                <?
                } else if ($finalPage == 'teacher') {
                    ?>
                        <div class="final_header_container">
                            <span>Преподаватель</span>
                        </div>
                <?

                } else {
                    echo ' <div class="input_container_admin">
                    <label id="labelAdmin">Администратор</label>
                    <input id="inputAdmin" type="radio" name="userRole" value="admin">
                </div>

                <div class="input_container_teacher">
                    <label id="labelTeacher">Преподаватель</label>
                    <input id="inputTeacher" type="radio" name="userRole" value="teacher">

                </div>


                <div class="input_container_student">
                    <label id="labelStudent">Студент</label>
                    <input id="inputStudent" type="radio" name="userRole" value="student">

                </div>';
                }
                ?>



                <div class="exit_btn_container">
                    <button type="button" class="exit_btn" onClick='location.href="registrationOut.php"'>Вернуться в
                        личный
                        кабинет</button>
                </div>



            </div>

            <div class="input_block">
                <?
                if (isset($_SESSION['studentWithFaculty']) and !empty($_SESSION['studentWithFaculty'])) {
                    ?>
                    <input class="input_data" type="text" placeholder="Введите Фамилию" name="lastName"
                        value="<?= $_SESSION['studentWithFaculty']['lastName'] ?>">
                    <input class="input_data" type="text" placeholder="Введите Имя" name="name"
                        value="<?= $_SESSION['studentWithFaculty']['name'] ?>">
                    <input class="input_data" type="text" placeholder="Введите Отчество" name="surname"
                        value="<?= $_SESSION['studentWithFaculty']['surname'] ?>">
                    <input class="input_data" type="text" placeholder="Введите Email" name="email"
                        value="<?= $_SESSION['studentWithFaculty']['email'] ?>">
                    <input class="input_data" type="text" placeholder="Введите Логин" name="login"
                        value="<?= $_SESSION['studentWithFaculty']['login'] ?>">
                    <input class="input_data" type="text" placeholder="Введите Пароль" name="password"
                        value="<?= $_SESSION['studentWithFaculty']['password'] ?>">
                <?

                } else if (isset($_SESSION['teacher']) and !empty($_SESSION['teacher'])) {
                    ?>
                        <input class="input_data" type="text" placeholder="Введите Фамилию" name="lastName"
                            value="<?= $_SESSION['teacher']['lastName'] ?>">
                        <input class="input_data" type="text" placeholder="Введите Имя" name="name"
                            value="<?= $_SESSION['teacher']['name'] ?>">
                        <input class="input_data" type="text" placeholder="Введите Отчество" name="surname"
                            value="<?= $_SESSION['teacher']['surname'] ?>">
                        <input class="input_data" type="text" placeholder="Введите Email" name="email"
                            value="<?= $_SESSION['teacher']['email'] ?>">
                        <input class="input_data" type="text" placeholder="Введите Логин" name="login"
                            value="<?= $_SESSION['teacher']['login'] ?>">
                        <input class="input_data" type="text" placeholder="Введите Пароль" name="password"
                            value="<?= $_SESSION['teacher']['password'] ?>">
                <?

                } else {
                    echo '
                <input class="input_data" type="text" placeholder="Введите Фамилию" name="lastName">
                <input class="input_data" type="text" placeholder="Введите Имя" name="name">
                <input class="input_data" type="text" placeholder="Введите Отчество" name="surname">
                <input class="input_data" type="text" placeholder="Введите Email" name="email">
                <input class="input_data" type="text" placeholder="Введите Логин" name="login">
                <input class="input_data" type="text" placeholder="Введите Пароль" name="password">
                ';
                }
                ?>

            </div>

            <div class="title_list " id="titleList">
                <span>Выберите привилегии</span>
            </div>
            <!-- Лист вывода для студентов  -->
            <div class="list_output_student hidden">
                <?php
                $countOfFaculty = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `faculties`"))[0][0];
                if ($countOfFaculty == 0) {
                    ?>
                    <div class="list_output_none">
                        <div class="list_output_none_text">
                            <span>Ни одного зарегистрированного факультета не обнаружено !</span>
                        </div>
                        <div class="exit_btn_container">
                            <button type="button" class="exit_btn_none" onClick='location.href="../faculty/faculty.php"'>Перейти к факультетам</button>
                    </div>
                    </div>
                    <?
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

                    ?>
                    <div class="faculty_content_button">
                        <div class="faculty_text_button">
                            <span>Далее</span>
                        </div>
                        <button type="submit" id="btn_form_faculties_next" class="btn_form" name="type_form"
                            value="studentFaculties"></button>


                    </div>
                <?
                }
                ?>
            </div>
            <!-- Конец листа вывода для студентов  -->


            <!-- Вывод групп для студентов -->
            <div class="list_output_student_group hidden">
                <?php
                $facultyId = $_SESSION['studentWithFaculty']['facultyId'];
                $countGroups = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `groups`
                WHERE `faculty_id` = '$facultyId'"))[0][0];

                if ($countGroups == 0) {
                    ?>
                    <div class="list_output_none">
                        <div class="list_output_none_text">
                            <span>Ни одной группы у этого факультета не зарегистрированно</span>
                        </div>
                        <div class="exit_btn_container">
                            <button type="button" class="exit_btn_none" onClick='location.href="../faculty/faculty.php"'>Перейти к факульетам</button>
                    </div>
                    </div>
                    <?
                } else {
                    $arrayOfGroups = mysqli_fetch_all(
                        mysqli_query(
                            $connect,
                            "SELECT `groups_name` FROM `groups` WHERE `faculty_id` = '$facultyId'"
                        )
                    ); // получаем id первой группы
                
                    $nextGroup = 0;


                    for ($i = 0; $i < $countGroups; $i++) {
                        $nameGroup = $arrayOfGroups[$nextGroup][0];
                        $idGroup = mysqli_fetch_all(
                            mysqli_query(
                                $connect,
                                "SELECT `groups_id` FROM `groups` WHERE `groups_name` = '$nameGroup'"
                            )
                        )[0][0];
                        echo '
                        <div class="faculty_content">
                        <div class="faculty_text">
                            <span>' . $arrayOfGroups[$nextGroup][0] . '</span>
                            
                        </div>
                    
                    <input type = "radio" class = "btn_form"  name = "groupId" value = "' . $idGroup . '">
                </div>';
                        $nextGroup++; // увеличиваем id первого элемента, т.е. получаем id 2 элемента
                
                    }
                    ?>

                    <div class="faculty_content_button_back">
                        <div class="faculty_text_button">
                            <span>Назад</span>
                        </div>
                        <button id="button_back_groups" type="button" class="btn_form"></button>


                    </div>


                    <div class="faculty_content_button">
                        <div class="faculty_text_button">
                            <span>Далее</span>
                        </div>
                        <button type="submit" id="btn_form_faculties_next" class="btn_form" name="type_form"
                            value="studentGroups"></button>

                    </div>
                <?
                }
                ?>
            </div>
            <!-- Конец вывода групп для студентов -->


            <!-- Лист вывода  для преподвателей -->
            <div class="list_output_teacher hidden">
                <?
                $countSubjects = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `subjects`"))[0][0];
                if ($countSubjects == 0) {
                    ?>
                    <div class="list_output_none">
                        <div class="list_output_none_text">
                            <span>Ни одного зарегистрированного предмета не обнаружено !</span>
                        </div>
                        <div class="exit_btn_container">
                            <button type="button" class="exit_btn_none" onClick='location.href="../subject/subject.php"'>Перейти к предметам</button>
                    </div>
                    </div>
                    <?
                } else {
                    $firstSubjectsId = mysqli_fetch_all(
                        mysqli_query(
                            $connect,
                            "SELECT `subjects_id` FROM `subjects` LIMIT 1"
                        )
                    )[0][0]; // получаем id первого предмета
                
                    for ($i = 0; $i < $countSubjects; $i++) { // заполняем правый блок, пока не будет 6 карточек
                        $subjectName = mysqli_fetch_all(mysqli_query($connect, "SELECT `subjects_name` FROM `subjects`
                            WHERE `subjects_id` = '$firstSubjectsId'"))[0][0];
                        echo '
                        <div class="faculty_content_teacher">
                        <div class="faculty_text">
                            <span>' . $subjectName . '</span>
                            
                        </div>
                        <input class = "checkboxTeacher" type = "checkbox" name = "subject' . $i . '" value = "' . $firstSubjectsId . '">
                </div>';
                        $firstSubjectsId++; // увеличиваем id первого элемента, т.е. получаем id 2 элемента
                    }
                    ?>

                    <div class="faculty_content_button">
                        <div class="faculty_text_button">
                            <span>Далее</span>

                        </div>
                        <input type="hidden" name="countOfSubjects" value="<?= $countSubjects ?>">
                        <button type="submit" id="btn_form_faculties_next" class="btn_form" name="type_form"
                            value="teacherNextFinal"></button>
                    </div>
                <?
                }
                ?>
            </div>
            <!-- Конец листа вывода  для преподвателей -->

            <!-- Лист вывода  для админов -->
            <div class="list_output_admin ">
            <div class="faculty_content_button">
                        <div class="faculty_text_button">
                            <span>Зарегистрировать</span>
                        </div>
                        <button type="submit" id="btn_form_faculties_next" class="btn_form" name="type_form"
                            value="adminRegister"></button>


                    </div>

            </div>
            <!-- Конец листа вывода  для админов -->

            <!--Начало  вывода финальной страницы студента -->
            <div class="list_output_student_final hidden">
                <div class="inner_container_student">
                    <div class="inner_container_student_title">
                        <span>Факультет</span>
                    </div>

                    <div class="faculty_content">
                        <div class="faculty_text">
                            <span>
                                <?= $facultyName = mysqli_fetch_all(
                                    mysqli_query(
                                        $connect,
                                        "SELECT `faculty_name` FROM `faculties` WHERE `faculty_id` = '" . $_SESSION['studentWithFaculty']['facultyId'] . "'"
                                    )
                                )[0][0] ?>
                            </span>

                        </div>

                    </div>

                    <div class="faculty_content_button_back">
                        <div class="faculty_text_button">
                            <span>К группам</span>
                        </div>
                        <button id="button_back_student_final" type="submit" class="btn_form" name="type_form"
                            value="studentBackToGroups"></button>
                        <?
                        if (isset($_SESSION['studentWithFaculty']['groupId'])) {
                            ?>
                                <input type="hidden" name="gropId" value="<?= $_SESSION['studentWithFaculty']['groupId'] ?>">
                                <input type="hidden" name="facultyId"
                                    value="<?= $_SESSION['studentWithFaculty']['facultyId'] ?>">
                        <?

                        }
                        ?>



                    </div>
                </div>

                <div class="inner_container_student">
                    <div class="inner_container_student_title">
                        <span>Группа</span>
                    </div>

                    <div class="faculty_content">
                        <div class="faculty_text">
                            <span>
                                <?= $groupName = mysqli_fetch_all(
                                    mysqli_query(
                                        $connect,
                                        "SELECT `groups_name` FROM `groups` WHERE `groups_id` = '" . $_SESSION['studentWithFaculty']['groupId'] . "'"
                                    )
                                )[0][0] ?>
                            </span>

                        </div>

                    </div>

                    <div class="faculty_content_button">
                        <div class="faculty_text_button">
                            <span>Зарегистрировать</span>
                        </div>
                        <button type="submit" id="btn_form_faculties_next" class="btn_form" name="type_form"
                            value="studentRegister"></button>


                    </div>
                </div>
            </div>
            <!--Конец вывода финальной страницы студента  -->

            <!--Начало  вывода финальной страницы преподавателя -->
            <div class="list_output_teacher_final hidden">
                <?
                $countSubjects = $_SESSION['teacher']['countOfSubjects'];
                for ($i = 0; $i < $countSubjects; $i++) {
                    $subjectId = $_SESSION['teacher']['subject' . $i];
                    $subjectName = mysqli_fetch_all(mysqli_query($connect, "SELECT `subjects_name` FROM `subjects` WHERE `subjects_id` = '$subjectId'"))[0][0];

                    echo '
                        <div class="faculty_content_teacher">
                        <div class="faculty_text">
                            <span>' . $subjectName . '</span>
                            
                        </div>
                </div>';
                }


                ?>

                <div class="faculty_content_button_back">
                    <div class="faculty_text_button">
                        <span>К выбору предметов</span>
                    </div>
                    <button id="buttonBackTeacher" type="submit" class="btn_form" name="type_form"
                        value="teacherBackToSubjects"></button>

                </div>

                <div class="faculty_content_button">
                <div class="faculty_text_button">
                    <span>Зарегистрировать</span>
                </div>
                <button type="submit" id="btn_form_faculties_next" class="btn_form" name="type_form"
                    value="teacherRegister"></button>


            </div>

            </div>


            


            <!--Конец вывода финальной страницы студента  -->
        </form>

    </main>

    <script src="../../js/registration.js"></script>

</body>

</html>