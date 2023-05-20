<?
session_start();
require_once '../../connection.php';
$userId = $_SESSION['dataOfUser']['userId'];
$teacherId = mysqli_fetch_all(mysqli_query($connect, "SELECT `teacher_id` FROM `teachers` WHERE `user_id` = '$userId'"))[0][0];
if (isset($_POST['post']) and !empty($_POST['post'])) {
    $post = $_POST['post'];
} else {
    $post = 'subjects';
}

// Заполнение сессии
if (isset($_POST['subjectId']) and !empty($_POST['subjectId'])) {
    $_SESSION['homework']['subjectId'] = $_POST['subjectId'];
} else if (isset($_POST['facultyId']) and !empty($_POST['facultyId'])) {
    $_SESSION['homework']['facultyId'] = $_POST['facultyId'];

} else if (isset($_POST['groupId']) and !empty($_POST['groupId'])) {
    $_SESSION['homework']['groupId'] = $_POST['groupId'];

}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Выбор предмета</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/teacher/homeworkChange.css">
    <link rel="stylesheet" href="../../css/teacher/diaryChange.css">
</head>

<body>
    <!-- span - служит для отображения контента -->
    <span id="span" hidden><?= $post ?></span>
    <div class="main_container" action=" " method="post">

        <div class="main_container_header">

            <div class="title_header">
                <span class="title_teacher_span">Выберите предмет</span>
            </div>

            <button onclick="location.href = 'diaryExit.php'" class="btn_exit">Вернуться в личный кабинет</button>
        </div>

        <div class="main_container_subject ">
            <?
            $countOfSubjects = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `teachers-subjects` WHERE `id_teacher` = '$teacherId'"))[0][0];
            $subjects = mysqli_fetch_all(mysqli_query($connect, "SELECT `id_subject` FROM `teachers-subjects` WHERE `id_teacher` = '$teacherId'"));
            for ($i = 0; $i < $countOfSubjects; $i++) {
                $idSubject = $subjects[$i][0];
                // Вывод предметов
                echo '
                <form action = " " method = "post" > 
                    <div class="faculty">
                    <div class="faculty_content">
                        <div class="faculty_text">
                            <span>'
                    . $facultyName = mysqli_fetch_all(
                        mysqli_query(
                            $connect,
                            "SELECT `subjects_name` FROM `subjects` 
                            WHERE `subjects_id` = '$idSubject'"
                        )
                    )[0][0] . // вытаскиваем имя факультета, по id первого факультета
                    '</span>
                            
                        </div>
                         <input type = "hidden" name = "subjectId" value ="' . $idSubject . '">
                         <input type = "hidden" name = "post" value = "faculties">
                        <input type = "submit" class = "submit_subject">
                    </div>
                   
                </div>
                </form>';
            }

            ?>
        </div>


        <div class="main_container_faculty hidden">
            <?
            $countFaculties = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `faculties`"))[0][0];
            $arrFaculties = mysqli_fetch_all(mysqli_query($connect, "SELECT * FROM `faculties`"));
            for ($i = 0; $i < $countFaculties; $i++) {
                $idFaculty = $arrFaculties[$i][0];
                $countGroupsInFaculty = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `groups` WHERE `faculty_id` = '$idFaculty'"))[0][0];
                if ($countGroupsInFaculty == 0)
                    continue;
                echo '
                <form action = "" method = "post" "> 
                    <div class="faculty">
                    <div class="faculty_content">
                        <div class="faculty_text">
                            <span>'
                    . $facultyName = mysqli_fetch_all(
                        mysqli_query(
                            $connect,
                            "SELECT `faculty_name` FROM `faculties` 
                            WHERE `faculty_id` = '$idFaculty'"
                        )
                    )[0][0] .
                    '</span>
                            
                        </div>
                        <input type = "submit" class = "submit_faculty">
                    </div>
                    <input type = "hidden" name = "facultyId" value ="' . $idFaculty . '">
                    <input type = "hidden" name = "post" value = "groups">
                </div>
                </form>';
            }



            ?>
        </div>

        <div class="main_container_group hidden">
            <?php
            $facultyId = $_SESSION['homework']['facultyId'];
            $countGroups = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `groups` WHERE `faculty_id` = '$facultyId'"))[0][0];
            $arrGroups = mysqli_fetch_all(mysqli_query($connect, "SELECT * FROM `groups` WHERE `faculty_id` = '$facultyId' "));

            for ($i = 0; $i < $countGroups; $i++) {
                $idGroup = $arrGroups[$i][0];
                echo '
                 <form action = " " method = "post"> 
                     <div class="faculty">
                     <div class="faculty_content">
                         <div class="faculty_text">
                             <span>'
                    . $groupName = mysqli_fetch_all(
                        mysqli_query(
                            $connect,
                            "SELECT `groups_name` FROM `groups` 
                             WHERE `groups_id` = '$idGroup'"
                        )
                    )[0][0] .
                    '</span>
                             
                         </div>
                         <input type = "submit" class = "submit_faculty">
                     </div>
                     <input type = "hidden" name = "groupId" value ="' . $idGroup . '">
                     <input type = "hidden" name = "post" value = "student">
                 </div>
                 </form>';
            }
            ?>
        </div>

        <div class="main_container_student hidden">
            <?php
            if (isset($_SESSION['homework']['groupId'])) {
                $idGroup = $_SESSION['homework']['groupId'];
                $countStudent = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `studients` WHERE `group_id` = '$idGroup'"))[0][0];
                $arrStudents = mysqli_fetch_all(mysqli_query($connect, "SELECT * FROM `studients` WHERE `group_id` = '$idGroup' "));


                for ($i = 0; $i < $countStudent; $i++) {
                    $idStudent = $arrStudents[$i][0];
                    $userId = mysqli_fetch_all(mysqli_query($connect, "SELECT `user_id` FROM `studients` WHERE `studient_id` = '$idStudent'"))[0][0];
                    ?>
                    <form method="post" action="diary.php">
                        <div class="profile_card">
                            <div class="profile_card_content">
                                <div class="profile_card_img">
                                    <?php
                                    $check_photo = mysqli_fetch_all(mysqli_query($connect, "SELECT `photo` FROM `studients` WHERE `user_id` = '$userId'"))[0][0];

                                    if ($check_photo === NULL) {
                                        echo '<img src="../../img/student/avatar.png" class="avatar">';
                                    } else {
                                        $path = '../../img/student/avatars/' . $check_photo;
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
                                    echo '<input type = "hidden" name="name" value = "' . $userFullName[0][1] . ' ' . mb_substr($userFullName[0][0], 0,1) . '.' . mb_substr($userFullName[0][2],0,1) . '.'. '">';
                                    echo '<input type = "hidden" name = "idOfStudent" value = "'.$idStudent.'">';
                                    ?>
                                </div>
                                <div class="email">
                                    <?php
                                    $userEmail = mysqli_fetch_all(mysqli_query($connect, "SELECT email FROM `studients` WHERE `user_id` = '$userId'"))[0][0];
                                    echo '<span>' . $userEmail . '</span>';
                                    ?>

                                </div>

                            </div>

                            <input class="btn-submit" type="submit">
                        </div>

                    </form>
                <?
                }
            }
            ?>
        </div>
    </div>

    <script src="../../js/diaryChange.js"></script>
</body>