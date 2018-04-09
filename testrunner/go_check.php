<?php

session_start();
$file = file($_SESSION['test_to_run']);
$a = $_POST['answer'];
$question_number = intval(htmlspecialchars(trim($_POST['x'])));
$type = $_SESSION['questions'][0]['t'];

//показываем предыдущий вопрос и ответ для этого переводим массив в строку.
is_array($a) ? $show = implode(",", $a) : $show = $a;
$prev_answer = explode("|", $file[$question_number])[2] . " [$show]";

function wrong_answer($q)
{
    $_SESSION['wrong_a'] = intval($_SESSION['wrong_a']) + 1;
    if ($_SESSION['result']) {
        unset($_SESSION['questions'][array_shift($_SESSION['questions'])]);
        $_SESSION['last_answer'] = "<span style='color: red; font-size: small;'>$q</span>";
        $_SESSION['last_answer_q'][] = $q;
    } else {
        $_SESSION['last_answer'] = "<span style='color: red; font-size: small;'>Ошибка</span>";
    }

    file_put_contents("txt/logs/log_users.txt", "-", FILE_APPEND);

    unset($_POST['answer']);
}

function correct_answer($q)
{
    $_SESSION['correct_a'] = intval($_SESSION['correct_a']) + 1;
    file_put_contents("txt/logs/log_users.txt", "+", FILE_APPEND);
    $_SESSION['last_answer'] = "<span style='color: green; font-size: small;'>$q</span>";
    unset($_SESSION['questions'][array_shift($_SESSION['questions'])]);
    unset($_POST['answer']);
}

/*
echo "Answer: " . $a . "<br>";
echo "Question number: " . $question_number . "<br>";
echo "TYPE: " . $type . "<br>";
echo "Correct: " . trim($file[intval($_POST['x']) + 1]) . "<br>";
print_r($_SESSION['questions']);
*/

if ($a) {

    //Если вопрос да-нет
    if ($type === 'yn') {

        if (trim($a) == trim($file[$question_number + 1])) {
            correct_answer($prev_answer);
            //echo "ВЕРНО";

        } else {

            wrong_answer($prev_answer);
            //echo "НЕВЕРНО";

        }
    }

    //Если вопрос обычный
    if ($type === 'o') {

        if (trim($a) == trim($file[$question_number + 2])) {
            correct_answer($prev_answer);
            //echo "ВЕРНО";

        } else {
            wrong_answer($prev_answer);
            //echo "НЕВЕРНО";
        }
    }

    //Если несколько вариантов ответа
    if ($type === 'mc') {

        //парсим верные ответы в массив
        $correct_answers = explode("|", trim($file[$_POST['x'] + 2]));

        //находим разницу в массиве
        $result = (count($correct_answers) === count($a)) && !count(array_diff($correct_answers, $a));

        /* Дебагинг
        echo 'Верные ответы: ';
        var_dump($correct_answers);
        echo "<br>";
        echo 'Полученные ответы: ';
        var_dump($a);
        echo "<br>";
        echo 'Разница: ';
        var_dump($result);
        echo "<br>";
        echo 'Каунт: ';
        echo count($result);
        echo "<br>";
        */

        if ($result) {
            correct_answer($prev_answer);
            //echo "ВЕРНО";

        } else
            wrong_answer($prev_answer);
        //echo "НЕВЕРНО";
    }
} else {

    $_SESSION['last_answer'] = "Не было ответа";

}

header("location: go.php");

?>
