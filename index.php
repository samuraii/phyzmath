<?php

session_start();

$user_data = $_SERVER['HTTP_USER_AGENT'];
file_put_contents('helpers/txt/logs/devices.txt', $user_data . "\n", FILE_APPEND);

require_once './db/config.php';
require_once './helpers/helper.php';
unset_quest();

$captcha = 0;

if (isset($_POST['g-recaptcha-response'])) {
    $captcha = json_decode(validate_captcha($_POST['g-recaptcha-response']))->{'success'};
}

if (isset($_POST['username']) && $_POST['username'] !== '' && (int)$captcha === 1) {
    $data_line = $_POST['username'] . ' ' . date(' j M Y h:i:s') . "\n";
    file_put_contents('helpers/txt/logs/log_users.txt', $data_line, FILE_APPEND);
    $_SESSION['username'] = $_POST['username'];
    $_SESSION['ava'] = $_POST['ava'];
    $_SESSION['auth'] = 1;
    setcookie('user', 'nice-little-cookie');
    header('location: cabinet/index.php');
}

?>


<!DOCTYPE html>
<html>

<head>
    <title>QUEST</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" href="css/basic.css" rel="stylesheet">
    <link type="text/css" href="css/index.css" rel="stylesheet">
</head>

<body>

<div class="welcome">

    <form method="post" action="index.php">

        <label>
            <input type="radio" name="ava" value="1" checked/>
            <img class="face" src="pictures/faces/default/1.png">
        </label>

        <label>
            <input type="radio" name="ava" value="2"/>
            <img class="face" src="pictures/faces/default/2.png">
        </label>

        <input name="username" type="text" maxlength="15" autocomplete="off" placeholder="введите имя" required>

        <input type="submit" value="Погнали"><br>

        <div id="captcha" class="g-recaptcha" data-sitekey="6LdwQjoUAAAAADzlYA8wb9IBcwF8jwxcVO50BSN6"></div>

    </form>

</div>
</body>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer> </script>
<script src="captcha.js"></script>
</html>
