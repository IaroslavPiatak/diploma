<?
require_once '../../connection.php';
session_start();
if(isset($_SESSION['alert']) AND $_SESSION['alert']['alert'] == 'true')
{
    $alert = 'true';
}
else
{
    $alert = 'false';
}





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
        <span class="hidden" id="alert"><?= $alert ?></span>

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

    <div class="modal"> <!--Модалка -->
        <div class="modal_box">
            <button class="cross-btn">
                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M4.20195 4.41681L4.18988 4.43078L4.17888 4.44561C3.80645 4.94755 3.84732 5.65912 4.30251 6.11432C4.30251 6.11432 4.30251 6.11432 4.30252 6.11432L10.6879 12.5L4.30251 18.8857C4.30251 18.8857 4.30251 18.8857 4.30251 18.8857C3.80216 19.3861 3.80216 20.1973 4.30251 20.6976C4.80286 21.198 5.61411 21.198 6.11447 20.6976C6.11447 20.6976 6.11448 20.6976 6.11448 20.6976L12.5002 14.3123L18.8859 20.6976L18.8988 20.7106L18.9127 20.7226L19.0003 20.7982L19.0143 20.8102L19.0291 20.8212C19.531 21.1937 20.2427 21.1529 20.6978 20.6976L20.7108 20.6846L20.7227 20.6708L20.7983 20.5832L20.8104 20.5692L20.8214 20.5545C21.1939 20.0525 21.153 19.3409 20.6978 18.8857C20.6978 18.8857 20.6977 18.8857 20.6977 18.8857L14.3125 12.5L20.6978 6.11433C20.6978 6.11433 20.6978 6.11432 20.6978 6.11431C21.1982 5.61396 21.1981 4.80271 20.6978 4.30236C20.1974 3.80201 19.3863 3.80201 18.8859 4.30235C18.8859 4.30235 18.8859 4.30236 18.8859 4.30236L12.5002 10.6877L6.11447 4.30235L6.10152 4.28941L6.08766 4.27744L6.00003 4.20179L5.98606 4.18973L5.97123 4.17873C5.46928 3.8063 4.75771 3.84717 4.30252 4.30236L4.28956 4.31532L4.27759 4.32918L4.20195 4.41681Z"
                        fill="#2F2D35" stroke="#2F2D35" />
                    </svg>
                    
            </button>
            <div class="modal_box_text"><span>Пользователь с таким логином уже существует</span></div>
        </div>
    </div>


    <script src="../../js/registration.js"></script>

</body>

</html>