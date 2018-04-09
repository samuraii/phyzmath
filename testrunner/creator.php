<?php

session_start();

$_SESSION['correct_a'] = 0;
$_SESSION['wrong_a'] = 0;

//проверка тренировка или на результат
if ($_POST['result'] == 0) {

    shuffle($_SESSION['questions']);
    $_SESSION['result'] = 0;

} elseif ($_POST['result'] == 1) {

    $_SESSION['questions'] = array_values($_SESSION['questions']);
    $_SESSION['result'] = 1;

}

if ($_POST['hints'] == 'with_hints') {

    $_SESSION['hints'] = 1;

} else {

    $_SESSION['hints'] = 0;

}

$_SESSION['last_answer'] = "Только начали";


//print_r($_SESSION['questions']);
//echo $_SESSION['total'] . "<br>";
//print_r($_POST);

header('location: ./go.php');

?>