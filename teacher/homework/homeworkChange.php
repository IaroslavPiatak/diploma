<?
session_start();
require_once '../../connection.php';
$userId = $_SESSION['dataOfUser']['userId'];
$teacherId = mysqli_fetch_all(mysqli_query($connect, "SELECT `teacher_id` FROM `teachers` WHERE `user_id` = '$userId'"))[0][0];
$_SESSION['homework'] = 
[
    
];
if(isset($_POST['subjectId']) and !empty($_POST['subjectId']))
{
    $_SESSION['homework']['subjectId'] = $_POST['subjectId'];

}
else if (isset($_POST['facultyId']) and !empty($_POST['facultyId']))
{
    $_SESSION['homework']['facultyId'] = $_POST['facultyId'];
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
</head>

<body>
    <div class="main_container" action=" " method="post">

        <div class="main_container_header">

            <div class="title_header">
                <span class="title_teacher_span">Выберите предмет</span>
            </div>

            <button onclick="location.href = 'homeworkExit.php'" class="btn_exit">Вернуться в личный кабинет</button>
        </div>

        <div class="main_container_subject ">
            <?
            $countOfSubjects = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `teachers-subjects` WHERE `id_teacher` = '$teacherId'"))[0][0];
            $subjects = mysqli_fetch_all(mysqli_query($connect, "SELECT `id_subject` FROM `teachers-subjects` WHERE `id_teacher` = '$teacherId'"));
            for ($i = 0; $i < $countOfSubjects; $i++) {
                $idSubject = $subjects[$i][0];
                echo '
                <form action = "" method = "post" onsubmit="return false;"> 
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
                        <input type = "button" class = "submit_subject">
                    </div>
                    <input type = "hidden" name = "subjectId" value ="' . $idSubject . '">
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
                echo '
                <form action = "" method = "post" onsubmit="return false;"> 
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
                    )[0][0].
                    '</span>
                            
                        </div>
                        <input type = "button" class = "submit_faculty">
                    </div>
                    <input type = "hidden" name = "facultyId" value ="' . $idFaculty . '">
                </div>
                </form>';
            }
            
        

            ?>
        </div>

        <div class="main_container_group hidden">
            <span>Группы</span>
        </div>
    </div>

            <script src="../../js/homeworkChange.js"></script>
</body>