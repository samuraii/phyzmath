<?php

session_start();

//проверка прохождения через стартовую страницу и открытие сессии
if ($_SESSION['auth'] != 1) header("location: ../index.php");

//проверка остались ли ещё вопросы
if (count($_SESSION['questions']) == 0) header("location: result.php");

$file = file($_SESSION['test_to_run']);
$n = array_values($_SESSION['questions'])[0]['q'];
$type = array_values($_SESSION['questions'])[0]['t'];

if ($type == 'yn') {
    $data['q'] = explode("|", $file[$n])[2];
    $data['a'] = ['да', 'нет'];
    $correct_hint = 1; //корректируем подсказку так как в yn меньше строк

} elseif ($type == 'mc') {
    $data['q'] = explode("|", $file[$n])[2];
    $data['a'] = explode("|", $file[$n + 1]);

} elseif ($type == 'o') {
    $data['q'] = explode("|", $file[$n])[2];
    $data['a'] = explode("|", $file[$n + 1]);
}

//Отладка echo $n . "<br>"; echo $type . "<br>"; print_r($_SESSION['questions']); print_r($_SESSION['questions']);

?>

<!doctype html>

<head>
    <title><?php echo $file[0]; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" href="../css/basic.css" rel="stylesheet">
    <link type="text/css" href="css/questpage.css" rel="stylesheet">
</head>

<body>

<header class="header">
    <?php include '../helpers/header.php'; ?>
</header>

<div class="wrapper">

    <div class="header-test">

        <h1 class="center"><?php echo $file[0]; ?></h1>

        <?php $_SESSION['result'] ? $status = $_SESSION['correct_a'] + $_SESSION['wrong_a'] : $status = $_SESSION['correct_a']; ?>

        <div class="status-bar" style="font-size: small">Прошлый вопрос: <?php echo $_SESSION['last_answer']; ?></div>

        <div id="myProgress"><!-- Програесс бар -->
            <div id="myBar"></div>
            <div class="status">Статус: <?php echo $status . "/" . $_SESSION['total']; ?></div>
        </div><!-- Програесс бар -->

    </div><!--header test-->

    <div class="question">
        <b style="color: black">Вопрос: </b><?php echo $data['q']; ?> <br>
    </div>

    <div class="options">

        <form action="go_check.php" method="post">

            <input type="hidden" value="<?php echo $n; ?>" name="x">

            <!-- Выводим ответы списком в случайном порядке -->

            <?php

            $answers = $data['a'];
            shuffle($answers); //перемешиваем варианты ответов

            if ($type != 'mc') { //если вопрос не multiple choice

                for ($i = 0; $i < count($answers); $i++) {
                    $t = $answers[$i];
                    $number = $i + 1;
                    //выводим ваианты ответов
                    echo "<button class='accordion' name='answer' value='$t'>$number) $t</button>";

                }

            } elseif ($type == 'mc') { //если вопрос multiple choice

                for ($i = 0; $i < count($answers); $i++) {
                    $t = $answers[$i];
                    $number = $i + 1;
                    //выводим варианты ответов
                    echo "<input id='$number' class='css-checkbox' type='checkbox' name='answer[]' value='$t'><label class='css-label' for='$number'>$number) $t</label><br>";
                }

                echo "<input type='submit' value='Ответить'>";
            }

            ?>

        </form>
    </div>

    <?php if (($_SESSION['hints'] == 1) && !$_SESSION['result'] && ($_SESSION['questions'][0]['h'] == 1)) {
        include 'hint.php';
    } ?>

</div> <!--wrapper-->

</body>

<script>
    var elem = document.getElementById("myBar");
    elem.style.width = <?php echo ($status / $_SESSION['total']) * 100;?> +'%';
</script>
