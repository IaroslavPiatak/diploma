<?
print_r($_POST);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Почта</title>
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../css/general_pages/mail/mailCreate.css">
</head>
<body>
    <div class="main_container">
        <div class="header">
            <div class="destination_container">
                <div class="left_container"><span>Получатель:</span></div>
                <div class="right_container">
                    <input maxlength="30" type="text" name="destination" placeholder="Напишите ФИО получателя">
                </div>
               
            </div>

            <div class="buttons">
                <button class="button_header">Отправить</button>
                <button class="button_header exit" onClick='location.href="mail.html"'>К письмам</button>
            </div>
        </div>  

        <div class="mail">
            <div class="hedder_mail">
                <input maxlength="50" type="text" name="theme" placeholder="Напишите тему письма">
            </div>
            <div class="textmail" contenteditable>
                <textarea contenteditable name="" id="" cols="30" rows="15" maxlength="600"  placeholder="Ваше сообщение"></textarea>
                
            </div>
        </div>
    </div>
    
</body>
</html>