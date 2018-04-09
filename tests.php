<?php

session_start();

include_once './helpers/helper.php';
unset_quest();

unset($_SESSION['correct_a'], $_SESSION['questions'], $_SESSION['result'], $_SESSION['last_answer']);

//проверка прохождения через стартовую страницу и открытие сессии
if ($_SESSION['auth'] != 1) {
    header('location: index.php');
}

//Заглушка для пользовательских тестов
if ($_SESSION['tests'] == 'user_tests') {
    header('location: helpers/zaglushka.html');
}

$tests = $_SESSION['tests'];

function listTests($folder)
{
    if ($this_folder = opendir($folder)) {
        while ($subfolder = readdir($this_folder)) {
            if ($subfolder != '.' && $subfolder != '..') {
                $file = file("$folder/$subfolder");
                echo "<button class='button' name='test' value='$subfolder'>$file[0]</button>";
            }
        }
    }
    closedir($this_folder);
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Quiz PLace</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" href="css/basic.css" rel="stylesheet">
    <link type="text/css" href="css/cabinet.css" rel="stylesheet">
</head>
<body>

<div class="wrapper">

    <header class="header">
        <?php include 'helpers/header.php'; ?>
    </header>

    <div class="cabinet center">

        <h1 class="center">Доступные тесты:</h1>

    <form action="testrunner/" method="get">
        <?php listTests("test_data/$tests/tests"); ?>
    </form>

        </div>

    <footer>

    </footer>

</div>

</body>
</html>
