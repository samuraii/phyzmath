<?php

session_start();

//проверка прохождения через стартовую страницу и открытие сессии
if ($_SESSION['auth'] != 1) header("location: ../index.php");

//проверка остались ли ещё вопросы
elseif (count($_SESSION['questions']) != 0) header("location: ../test.php");

?>

<!doctype html>

<head>
    <title>NETS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" href="../css/basic.css" rel="stylesheet">
    <link type="text/css" href="../css/cabinet.css" rel="stylesheet">
</head>

<body>

<div class="wrapper">

    <header class="header">
        <?php include '../helpers/header.php'; ?>
    </header>

    <div class="cabinet center">

        <div class=" block informer width100 center-text">
            <?php echo $_SESSION['username'] . ", вы завершили тренировочное тестирование по курсу: " . file($_SESSION['test_to_run'])[0] . "<br>"?>
            <br>

            <?php

            if ($_SESSION['result'] == 1) {

                echo "Ваш результат: " . round((100 - ($_SESSION['wrong_a']/$_SESSION['total']) * 100)) . "%" . "<br>";

                if(count($_SESSION['last_answer_q']) > 0) {
                    echo "<br>";
                    echo "<b>Вопросы в которых были допущены ошибки:</b>" . "<br>";

                    $i = 1;

                    foreach ($_SESSION['last_answer_q'] as $q)
                    {
                        echo $i . ") " . $q . "<br>";
                        $i++;
                    }

                }

            } elseif ($_SESSION['result'] == 0) {

                echo "Неверных ответов: " . $_SESSION['wrong_a'];

            }
              ?>

        </div>

        <br>

        <a href="../tests.php" class="button center">Вернуться к списку тестов</a>

    </div>

</div>

</body>
