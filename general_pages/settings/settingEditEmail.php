<!-- Made by Iaroslav Piatak -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/general_pages/settings/settingEdit.css">
    <title>Настройки</title>
</head>

<body>
    <main>
        <div class="content_container">

            <div class="setting_container">
                <div class="left_block">
                    <div class="card_setting">
                        <div class="card_setting_content">
                            <div class="img_block">
                                <img>
                            </div>
                            <div class="title">
                                <span>Настройки</span>
                            </div>

                            <div class="exit">
                                <span>Вернуться в личный кабинет</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right_block">
                   <div class="form_block">
                    <div class="form_block_content">
                    <form method="post" action="settingEdit.php">
                            <input type = "text" class="text_input" name="oldEmail" placeholder = "Введите старую почту">
                            <input type = "text" class="text_input" name="newEmail" placeholder = "Введите новую почту">
                            <input type="hidden" name="action" value="email"  hiden>
                            <button type = "submit">Подтвердить</button>
                        </form>

                    </div>

                   </div>
                </div>
            </div>




        </div>

    </main>

</body>

</html>