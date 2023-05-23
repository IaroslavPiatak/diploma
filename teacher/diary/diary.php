<?php

session_start();
require_once '../../connection.php';

if(isset($_SESSION['homework']['action']) AND $_SESSION['homework']['action']  == 'homeworkAnswer')
{
    $subjectId = $_SESSION['homework']['subjectId'];
    $studentId = $_SESSION['homework']['idOfStudent'];
    $userFullName = mysqli_fetch_all(mysqli_query($connect, "SELECT `first_name`, `last_name`, `surname` FROM `studients` WHERE `studient_id` = '$studentId'"));
    $name = $userFullName[0][1] . ' ' . mb_substr($userFullName[0][0], 0,1) . '.' . mb_substr($userFullName[0][2],0,1) . '.';
    $_SESSION['homework']['name'] = $name;

}
if (isset($_POST['comment'])) {
    $comment = $_POST['comment'];
    $grade = $_POST['grade'];
    $subjectId = $_SESSION['homework']['subjectId'];
    $studentId = $_SESSION['homework']['idOfStudent'];
    // id оценки , оценка, id предмета, id студента, комментарий, день, месяц, год.
    $dayOfGrade = $_POST['dayOfGrade'];
    $month = $_POST['month'];
    $year = $_POST['year'];

    mysqli_query($connect, "INSERT INTO `greades`( `grade`, `subjectId`, `studentId`, `comment`, `day`, `month`, `year`) 
    VALUES ('$grade','$subjectId','$studentId','$comment','$dayOfGrade','$month','$year')");
}
if (isset($_POST['idOfStudent'])) {
    $_SESSION['homework']['idOfStudent'] = $_POST['idOfStudent'];
    $_SESSION['homework']['name'] = $_POST['name'];
}
if (isset($_POST['year']) and isset($_POST['month'])) {
    $year = $_POST['year'];
    $month = $_POST['month'];
    $dayCount = cal_days_in_month(CAL_GREGORIAN, $month, $year);
}

if (isset($_POST['dayOfGrade'])) {
    $modal = 'true';
} else
    $modal = 'false';

if (isset($_POST['modal'])) {
    $modal = 'false';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Журнал</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/teacher/diary.css">

</head>

<body>
    <span hidden id="modal"><?= $modal ?></span>
    <div class="main_container">
        <div class="main_container_header">
            <form action=" " method="post">
                <div class="date_change">
                    <select required name="year" class="select_year">
                        <option selected="true" disabled="disabled" value=" ">Год</option>
                        <?
                        $year = date('Y');
                        for ($i = 2023; $i <= $year; $i++) {
                            echo '<option  value = "' . $i . '">' . $i . '</option>';
                        }
                        ?>
                    </select>
                    <select required name="month" class="select_month">
                        <option selected="true" disabled="disabled" value=" ">Месяц</option>
                        <option value="1">Январь</option>
                        <option value="2">Февраль</option>
                        <option value="3">Март</option>
                        <option value="4">Апрель</option>
                        <option value="5">Май</option>
                        <option value="6">Июнь</option>
                        <option value="7">Июль</option>
                        <option value="8">Август</option>
                        <option value="9">Сентябрь</option>
                        <option value="10">Октябрь</option>
                        <option value="11">Ноябрь</option>
                        <option value="12">Декабрь</option>
                    </select>

                    <button type="submit" class="submit">Принять</button>
                </div>
            </form>
            <?
            if(isset($_SESSION['homework']['action']) AND $_SESSION['homework']['action']  == 'homeworkAnswer')
            {
                ?>
                <form method = "post" action = "../homework/homeworkCreate.php">
                    <input type="hidden" name = "action" value = "read">
                    <input type="hidden" name = "idHomework" value = "<?=$_SESSION['homework']['idHomework']?>">
                    <button type="submit"  class="exit">Назад</button>
            </form>
               
                <?     
            }
            else
            {
                ?>
             <button onclick="location.href = 'diaryExit.php'" class="exit">Выйти</button>
            <?
            }
            
            ?>
        </div>

        <div class="main_container_calendar">
            <?
            if (isset($dayCount)) {
                for ($i = 1; $i <= $dayCount; $i++) {
                    $dayOfWeek = getdate(strtotime($year . '-' . $month . '-' . $i))['wday'];
                    switch ($dayOfWeek) {
                        case 0:
                            $dayOfWeek = 'Вс';
                            break;
                        case 1:
                            $dayOfWeek = 'Пн';
                            break;
                        case 2:
                            $dayOfWeek = 'Вт';
                            break;
                        case 3:
                            $dayOfWeek = 'Ср';
                            break;
                        case 4:
                            $dayOfWeek = 'Чт';
                            break;
                        case 5:
                            $dayOfWeek = 'Пт';
                            break;
                        case 6:
                            $dayOfWeek = 'Сб';
                            break;
                    }
                    $subjectId = $_SESSION['homework']['subjectId'];
                    $studentId = $_SESSION['homework']['idOfStudent'];
                    ?>
                    <form class = "facultyBtnContent" action="" method="post">
                        <div class="day">
                            <div class="dayOfWeek">
                                <span>
                                    <?= $i ?> -
                                    <?= $dayOfWeek ?>
                                </span>
                            </div>
                            <div class="grade">
                                <?
                                if ($checkGrade = mysqli_fetch_all(mysqli_query($connect, "SELECT `grade` FROM `greades` WHERE `subjectId` = '$subjectId' AND `studentId` = '$studentId' AND `day` = '$i' AND `month` = '$month' AND `year` = '$year'"))) {
                                    echo '<span class = "gradeForJs">Оценка: ' . $checkGrade[0][0] . '</span>';

                                }
                                ?>
                            </div>
                            <input type="hidden" name="dayOfGrade" value="<?= $i ?>">
                            <input type="hidden" name="month" value="<?= $month ?>">
                            <input type="hidden" name="year" value="<?= $year ?>">
                            <input type="submit" class="submitInput facultyBtn">
                        </div>
                    </form>
                <?
                }
            } else {
                ?>
                <div class="warning">
                    <div class="warning_content">
                        <div class="warning_img">
                            <img src="/img/teacher/clock.png" class="icon2">
                        </div>
                        <div class="warning_text">
                            <span>Выберите дату</span>
                        </div>
                    </div>
                </div>
                <style>
                    .main_container {

                        height: 600px;

                    }

                    .main_container_calendar {
                        height: 400px;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                    }
                </style>
            <?
            }
            ?>
        </div>
    </div>

    <form action=" " method="post">
        <div class="modal"> <!--Подложка, затемняющая основной контент-->
            <div class="modal_box">
                <button type="button" class="cross-btn">
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4.20195 4.41681L4.18988 4.43078L4.17888 4.44561C3.80645 4.94755 3.84732 5.65912 4.30251 6.11432C4.30251 6.11432 4.30251 6.11432 4.30252 6.11432L10.6879 12.5L4.30251 18.8857C4.30251 18.8857 4.30251 18.8857 4.30251 18.8857C3.80216 19.3861 3.80216 20.1973 4.30251 20.6976C4.80286 21.198 5.61411 21.198 6.11447 20.6976C6.11447 20.6976 6.11448 20.6976 6.11448 20.6976L12.5002 14.3123L18.8859 20.6976L18.8988 20.7106L18.9127 20.7226L19.0003 20.7982L19.0143 20.8102L19.0291 20.8212C19.531 21.1937 20.2427 21.1529 20.6978 20.6976L20.7108 20.6846L20.7227 20.6708L20.7983 20.5832L20.8104 20.5692L20.8214 20.5545C21.1939 20.0525 21.153 19.3409 20.6978 18.8857C20.6978 18.8857 20.6977 18.8857 20.6977 18.8857L14.3125 12.5L20.6978 6.11433C20.6978 6.11433 20.6978 6.11432 20.6978 6.11431C21.1982 5.61396 21.1981 4.80271 20.6978 4.30236C20.1974 3.80201 19.3863 3.80201 18.8859 4.30235C18.8859 4.30235 18.8859 4.30236 18.8859 4.30236L12.5002 10.6877L6.11447 4.30235L6.10152 4.28941L6.08766 4.27744L6.00003 4.20179L5.98606 4.18973L5.97123 4.17873C5.46928 3.8063 4.75771 3.84717 4.30252 4.30236L4.28956 4.31532L4.27759 4.32918L4.20195 4.41681Z"
                            fill="#2F2D35" stroke="#2F2D35" />
                    </svg>

                </button>
                <div class="modal_box_content">
                    <div class="title">
                        <div class="leftBlock">
                            <span>Студент :</span>
                        </div>
                        <div class="rightBlock">
                            <?
                            print_r($_SESSION['homework']['name']);
                            ?>
                        </div>
                    </div>

                    <div class="gradeContainer">
                        <span class="gradeSpan">Оценка:</span>
                        <div id="g1" class="gradeSelect">
                            <input required id="r1" class="radio" type="radio" name="grade" value="2">
                            <span id="t1">2</span>
                        </div>
                        <div id="g2" class="gradeSelect">
                            <input id="r2" class="radio" type="radio" name="grade" value="3">
                            <span id="t2">3</span>
                        </div>
                        <div id="g3" class="gradeSelect">
                            <input id="r3" class="radio" type="radio" name="grade" value="4">
                            <span id="t3">4</span>
                        </div>
                        <div id="g4" class="gradeSelect">
                            <input id="r4" class="radio" type="radio" name="grade" value="5">
                            <span id="t4">5</span>
                        </div>
                    </div>

                    <div class="bottom">
                        <input name="comment" type="text" class="comment" maxlength="45" placeholder="Ваш комментарий">

                        <button class="gradeSubmit">Выставить оценку</button>
                    </div>
                    <input type="hidden" name="year" value="<?= $year ?>">
                    <input type="hidden" name="month" value="<?= $month ?>">
                    <input type="hidden" name="dayOfGrade" value="<?= $_POST['dayOfGrade'] ?>">
                    <input type="hidden" name="modal" value="false">





                </div>
            </div>
    </form>
    <script src = "../../js/hoverAndAction.js"></script>
    <script>

setInterval(function () {
    let dayOfWeek =  document.querySelectorAll('.dayOfWeek');
    let grade =  document.querySelectorAll('.grade');
    let submitInput  = document.querySelectorAll('.submitInput');
    let gradeForJs = document.querySelectorAll('.gradeForJs');
    for(let i = 0; i < dayOfWeek.length; i++)
    
    if(grade[i].innerHTML.indexOf('span') != -1)
    {
     grade[i].style.cursor = "not-allowed";
     dayOfWeek[i].style.cursor = "not-allowed";
     submitInput[i].style.display = "none";
    }
    

}, 1000);

        setInterval(function () { // проверяет введена ли дата
            let radio = document.querySelectorAll('.radio');
            let count = 0;
            for (let i = 0; i < radio.length; i++) {
                if(radio[i].checked)
                {
                document.querySelector(".gradeSubmit").style.cursor = "pointer";
                document.querySelector(".gradeSubmit").addEventListener("click", () => {
                document.querySelector(".modal").classList.remove("open");
            });
            break;
                clearInterval();
        }
                else 
                document.querySelector(".gradeSubmit").style.cursor = "not-allowed";
            }
            
        }
            , 1000);
        const modal = document.getElementById("modal");

        if (modal.innerHTML == 'true') {

            document.querySelector(".modal").classList.add("open");

            document.querySelector(".cross-btn").addEventListener("click", () => {
                document.querySelector(".modal").classList.remove("open");

            });

            window.addEventListener('keydown', (e) => {
                if (e.key === "Escape") {
                    document.querySelector(".modal").classList.remove("open");
                }
            });

        }

        const radio1 = document.getElementById('r1');
        const grade1 = document.getElementById('g1');
        const text1 = document.getElementById('t1');
        const radio2 = document.getElementById('r2');
        const grade2 = document.getElementById('g2');
        const text2 = document.getElementById('t2');
        const radio3 = document.getElementById('r3');
        const grade3 = document.getElementById('g3');
        const text3 = document.getElementById('t3');
        const radio4 = document.getElementById('r4');
        const grade4 = document.getElementById('g4');
        const text4 = document.getElementById('t4');


        radio1.addEventListener('click', () => {
            grade1.style.border = "2px solid #8F7ECE";
            text1.style.color = "#8F7ECE";

            grade2.style.border = "2px solid #2F2D35";
            text2.style.color = "#2F2D35";
            grade3.style.border = "2px solid #2F2D35";
            text3.style.color = "#2F2D35";
            grade4.style.border = "2px solid #2F2D35";
            text4.style.color = "#2F2D35";


        })

        radio2.addEventListener('click', () => {
            grade2.style.border = "2px solid #8F7ECE";
            text2.style.color = "#8F7ECE";

            grade1.style.border = "2px solid #2F2D35";
            text1.style.color = "#2F2D35";
            grade3.style.border = "2px solid #2F2D35";
            text3.style.color = "#2F2D35";
            grade4.style.border = "2px solid #2F2D35";
            text4.style.color = "#2F2D35";


        })

        radio3.addEventListener('click', () => {
            grade3.style.border = "2px solid #8F7ECE";
            text3.style.color = "#8F7ECE";

            grade1.style.border = "2px solid #2F2D35";
            text1.style.color = "#2F2D35";
            grade2.style.border = "2px solid #2F2D35";
            text2.style.color = "#2F2D35";
            grade4.style.border = "2px solid #2F2D35";
            text4.style.color = "#2F2D35";


        })

        radio4.addEventListener('click', () => {
            grade4.style.border = "2px solid #8F7ECE";
            text4.style.color = "#8F7ECE";

            grade1.style.border = "2px solid #2F2D35";
            text1.style.color = "#2F2D35";
            grade2.style.border = "2px solid #2F2D35";
            text2.style.color = "#2F2D35";
            grade3.style.border = "2px solid #2F2D35";
            text3.style.color = "#2F2D35";


        })


    </script>
</body>

</html>