<!-- Mady by Iaroslav Piatak (php) -->
<?php
require_once '../../connection.php';

if (isset($_POST['facultyName'])) {
    $facultyName = $_POST['facultyName'];
    $checkFaculty = mysqli_fetch_all(mysqli_query($connect, "SELECT COUNT(*) FROM `faculties`
                                WHERE `faculty_name` = '$facultyName'"))[0][0];
    if ($checkFaculty == 0) {
        mysqli_query($connect, "INSERT INTO `faculties`(`faculty_name`) VALUES ('$facultyName')");
        header('Location:faculty.php');

    } elseif ($checkFaculty > 0) {

        ?>
        <script async src="../../js/alert.js"></script>
    <?
    }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/admin/faculty/faculty_create.css">
    <title>Факультеты</title>
</head>

<body>
    <main>
        <div class="main_container">
            <div class="inner_container">
                <div class="left_block">
                    <div class="profile_faculty">
                        <div class="profile_setting_content">
                            <div class="img_block">
                                <img src="/img/admin/faculty/universitygraduatehat_104965 1.png" class="icon2">
                            </div>
                            <div class="title">
                                <span>Факультеты</span>
                            </div>
                            <div class="exit">
                                <a href="../paAdmin.php">Вернуться в личный кабинет</a>
                            </div>
                        </div>
                    </div>
                    <a href="faculty.php">
                        <div class="register_faculty">
                            <div class="register_faculty_content">
                                <div class="text">
                                    <span>Вернуться к факультетам</span>
                                </div>
                                <div class="img">
                                    <img src="/img/admin/faculty/Group (1).png" class="icon1">
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="right_block">
                    <div class="create">
                        <div class="create_content">
                            <form class="container_input" method="post" action="">
                                <input type="text" class="text_input" name="facultyName"
                                    placeholder="Введите название факультета">
                                <button type="submit">Подтвердить</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Модалка -->
        <div class="modal"> <!--Подложка, затемняющая основной контент-->
            <div class="modal_box">
                <button class="cross-btn">
                    <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M4.20195 4.41681L4.18988 4.43078L4.17888 4.44561C3.80645 4.94755 3.84732 5.65912 4.30251 6.11432C4.30251 6.11432 4.30251 6.11432 4.30252 6.11432L10.6879 12.5L4.30251 18.8857C4.30251 18.8857 4.30251 18.8857 4.30251 18.8857C3.80216 19.3861 3.80216 20.1973 4.30251 20.6976C4.80286 21.198 5.61411 21.198 6.11447 20.6976C6.11447 20.6976 6.11448 20.6976 6.11448 20.6976L12.5002 14.3123L18.8859 20.6976L18.8988 20.7106L18.9127 20.7226L19.0003 20.7982L19.0143 20.8102L19.0291 20.8212C19.531 21.1937 20.2427 21.1529 20.6978 20.6976L20.7108 20.6846L20.7227 20.6708L20.7983 20.5832L20.8104 20.5692L20.8214 20.5545C21.1939 20.0525 21.153 19.3409 20.6978 18.8857C20.6978 18.8857 20.6977 18.8857 20.6977 18.8857L14.3125 12.5L20.6978 6.11433C20.6978 6.11433 20.6978 6.11432 20.6978 6.11431C21.1982 5.61396 21.1981 4.80271 20.6978 4.30236C20.1974 3.80201 19.3863 3.80201 18.8859 4.30235C18.8859 4.30235 18.8859 4.30236 18.8859 4.30236L12.5002 10.6877L6.11447 4.30235L6.10152 4.28941L6.08766 4.27744L6.00003 4.20179L5.98606 4.18973L5.97123 4.17873C5.46928 3.8063 4.75771 3.84717 4.30252 4.30236L4.28956 4.31532L4.27759 4.32918L4.20195 4.41681Z"
                            fill="#2F2D35" stroke="#2F2D35" />
                    </svg>

                </button>
                <div class="modal_box_text"><span>Такой факультет уже существует !</span></div>
            </div>
        </div>
    </main>






</body>

</html>