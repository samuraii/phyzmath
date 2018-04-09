<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Oops..</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link type="text/css" href="../../css/basic.css" rel="stylesheet">
    <link type="text/css" href="../../css/cabinet.css" rel="stylesheet">
</head>

<body>

<div class="wrapper">

    <header class="header">
        <?php echo "<img src='../../logo.png' height='49'>"; ?>
    </header>

    <?php

    $conn_questions = mysqli_connect('', '', '', '');
    if ($conn_questions->connect_error) {
        die('Connection failed');
    } else {
        echo 'Connect to questions success'.'<br>';
    }

    ?>

    <div class="cabinet center">

        <form action="tests_sql.php" method="post">
            <legend>Добавление теста</legend>

            <input name="nazvanie" type="text">

            <select name="category">

            </select>

            <select name="razdel">

            </select>

            <input name="filename" type="text">

            <select name="access">
                <option>Доступно всем</option>
                <option>Недоступно никому</option>
            </select>

        </form>

    </div>

</div>

</body>
</html>
