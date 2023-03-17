<!DOCTYPE html>
<html>
<head>
<title>METANIT.COM</title>
<meta charset="utf-8" />
</head>
<body>
<?php
if ($_FILES && $_FILES["filename"]["error"]== UPLOAD_ERR_OK) // Если поле массива error = 0 ИЛИ не имеет ошибок, то загружаем файл
{
    $name = "../../" . $_FILES["filename"]["name"]; // сохраняем имя файла
    move_uploaded_file($_FILES["filename"]["tmp_name"], $name); // в функции передаем временное расположение файла и его имя
    echo "Файл загружен";
}
?>
<h2>Загрузка файла</h2>
<form method="post" enctype="multipart/form-data">
Выберите файл: <input type="file" name="filename" size="10" accept="image/*,image/jpeg" />
<input type="submit" value="Загрузить" />
</form>

<?php
print_r($_FILES['filename']['name']);
?>
</body>
</html>