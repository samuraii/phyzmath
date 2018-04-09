<?php

session_start();

include '../helpers/helper.php';
unset_quest();

$_SESSION['test_to_run'] = "../test_data/" . $_SESSION['tests'] . "/tests/" . $_GET['test'];

function parseQuestionFile($test_to_parse)
{
    $test_file = file("$test_to_parse");

    for ($i = 5; $i < count($test_file); $i++) {
        if ($test_file[$i][0] === 'q') {
            $line = explode("|", $test_file[$i]);
            $_SESSION['questions'][$line[1]]['q'] = $i;
            $_SESSION['questions'][$line[1]]['t'] = trim($line[3]);
            if ($test_file[$i + 3][0] === 'h' || $test_file[$i + 2][0] === 'h') {
                $_SESSION['questions'][$line[1]]['h'] = 1;
                $_SESSION['has_hints'] = 1;
            }
        }
    }
    return $test_file;
}

$parsed = parseQuestionFile($_SESSION['test_to_run']);
$_SESSION['total'] = count($_SESSION['questions']);

//print_r($_SESSION['questions']);

?>

<!doctype html>

<html xmlns="http://www.w3.org/1999/html">

<head>
    <title>Настройки теста</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" href="../css/basic.css" rel="stylesheet">
    <link type="text/css" href="css/options.css" rel="stylesheet">
<body>

<div class="wrapper">

    <header class="header">
        <?php include '../helpers/header.php'; ?>
    </header>


    <fieldset class="center block description">

        <legend class="center"><b><?php echo $parsed[0]; ?></b></legend>

        <span
            class="block"><b>Author: </b> <?php echo $parsed[1]; ?></span>
        <span
            class="block"><b>Category: </b> <?php echo $parsed[2]; ?></span>
        <span
            class="block"><b>Tags: </b> <?php echo $parsed[3]; ?></span>

        <?php if ($_SESSION['has_hints'] === 1) echo "<span class='block'><b>Hints: </b>Есть</span>"; ?>

        <span
            class="block"><b>Type: </b> <?php echo $parsed[4]; ?></span>
        <span
            class="block"><b>Questions: </b> <?php echo count($_SESSION['questions']); ?></span>
    </fieldset>


    <form method="post" action="creator.php">

        <fieldset class="center block description">

            <legend class="center"><b>Настройки</b></legend>

            <div class="radio-toolbar">

                <?php if ($_SESSION['has_hints'] === 1) echo <<<END
                
                <input class="option" id="no_hints" type="radio" name="hints" value="no_hints"
                       title="Без подсказок" checked>
                <label for="no_hints">Без подсказок</label>
                
                <input class="option" id="hints" type="radio" name="hints" value="with_hints"
                       title="С подсказками">
                <label for="hints">С подсказками</label> <br>
END;
                ?>

                <input class="option" id="training" type="radio" name="result" value="0" title="Тринировка"
                       checked>
                <label for="training">Тренировка</label>

                <input class="option" id="forresult" type="radio" name="result" value="1" title="На результат">
                <label for="forresult">На результат</label><br>

                <input type="submit" class="button center" value="Начать тест">
                <div>

        </fieldset>

    </form>

</div>

<footer>

</footer>

</body>
</html>
