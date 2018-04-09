<?php

session_start();

include_once '../helpers/helper.php';

unset($_SESSION['correct_a'], $_SESSION['questions'], $_SESSION['result'], $_SESSION['last_answer']);

unset($_SESSION['correct_a'], $_SESSION['questions'], $_SESSION['result'], $_SESSION['last_answer']);

//проверка прохождения через стартовую страницу и открытие сессии
if ($_SESSION['auth'] != 1) {
    header('location: ../index.php');
}

if (isset($_POST['tests'])) {
    $_SESSION['tests'] = $_POST['tests'];
    header('location: ../tests.php');
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>QUEST</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" href="../css/basic.css" rel="stylesheet">
    <link type="text/css" href="../css/cabinet.css" rel="stylesheet">
</head>

<body>

<div class="wrapper">

    <header class="header">
        <?php echo "<img src='../logo.png' height='49'>"; ?>
    </header>

    <div class="cabinet center">

        <div class="user-info">

            <div class="user-details">
                <?php echo $_SESSION['username']; ?>
            </div>

            <img class="user-pic" src='../pictures/faces/default/<?php echo $_SESSION['ava']; ?>.png'>

        </div>

        <div class="test-list">

            <a class="button" href="numbers/countinmind/">Игра в числа</a>
            <a class="button" href="numbers/squarecount">Числовой квадрат</a>
            <a class='button quit' href='../helpers/logout.php'>Выйти</a>

        </div>

    </div>

</div> <!--wrapper-->

<footer>

</footer>

</body>

</html>
