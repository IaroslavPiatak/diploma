<!-- Mady by Iaroslav Piatak (php) -->
<?php
require_once '../../connection.php';
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
                                <a href="faculty.php">К факультетам</a>
                            </div>
                        </div>
                    </div>
                    <div class="register_faculty">
                        <div class="register_faculty_content">
                            <div class="text">
                                <span>Зарегистрировать новый факультет</span>
                            </div>
                            <div class="img">
                                <img src="/img/admin/faculty/Group (1).png" class="icon1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right_block">
                    <div class="create">
                        <div class="create_content">
                            <form class="container_input" method="post" action="">
                                <input type="text" class="text_input" name="facultyName"
                                    placeholder="Введите название факультета">
                                <button type="submit">Подтвердить</button>
                            </form>
                            <?php
                            if (!empty($_POST['facultyName'])) {
                                $facultyName = $_POST['facultyName'];
                                mysqli_query($connect, "INSERT INTO `faculties`(`faculty_name`) VALUES ('$facultyName')");
                                header('Location:faculty.php');
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>