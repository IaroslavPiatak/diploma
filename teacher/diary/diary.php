<?php
print_r($_POST);
$dayCount = cal_days_in_month(CAL_GREGORIAN, 5, 2023);
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
    <div class="main_container">
        <div class="main_container_header">
            <form action=" " method="post">
                <div class="date_change">
                    <select name = "year" class="select_year">
                        <option  selected="true" disabled="disabled">Год</option>
                        <?
                        $year = date('Y');
                        for ($i = 2023; $i <= $year; $i++) {
                            echo '<option  value = "'.$i.'">' . $i . '</option>';
                        }
                        ?>
                    </select>

                    <select name = "month" class="select_month">
                        <option selected="true" disabled="disabled">Месяц</option>
                        <option value = "1">Январь</option>
                        <option  value = "2">Февраль</option>
                        <option  value = "3">Март</option>
                        <option  value = "4">Апрель</option>
                        <option  value = "5">Май</option>
                        <option  value = "6">Июнь</option>
                        <option  value = "7">Июль</option>
                        <option  value = "8">Август</option>
                        <option  value = "9">Сентябрь</option>
                        <option  value = "10">Октябрь</option>
                        <option  value = "11">Ноябрь</option>
                        <option  value = "12">Декабрь</option>
                    </select>

                    <button type="submit" class="submit">Принять</button>
                </div>
            </form>
            <button class="exit">Выйти</button>
        </div>
        
        <div class="main_container_calendar">

        </div>
    </div>
</body>

</html>