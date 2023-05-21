<?
session_start();
require_once '../../connection.php';
$userId = $_SESSION['dataOfUser']['userId'];
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
    <div class="main_container">

        <div class="main_container_header">

            <div class="title_header">
                <span class="title_teacher_span">Выберите предмет</span>
            </div>

            <button onclick="location.href = 'diaryExit.php'" class="btn_exit">Вернуться в личный кабинет</button>
        </div>

        <div class="main_container_subject ">
            <?
            $countOfSubjects = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `subjects`"))[0][0];
            $subjects = mysqli_fetch_all(mysqli_query($connect, "SELECT * FROM `subjects`"));
            for ($i = 0; $i < $countOfSubjects; $i++) {
                $idSubject = $subjects[$i][0];
                // Вывод предметов
                echo '
                <form action = "diary.php" method = "post" > 
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
                    )[0][0] . 
                    '</span>
                            
                        </div>
                         <input type = "hidden" name = "subjectId" value ="' . $idSubject . '">
                        <input type = "submit" class = "submit_subject">
                    </div>
                   
                </div>
                </form>';
            }

            ?>
        </div>
    </div>
</body>