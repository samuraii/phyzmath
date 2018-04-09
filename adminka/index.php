<?php
if ($_GET['admin'] === 'iamanadmin') {
    $message = "<h1 class='center'>You are admin!</h1>";
} else {
    header('location: ../index.php');
}
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Oops..</title>
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
        <?php echo $message ?>
        <a class="button" href="dbase/index.php">Добавление / Удаление</a>
        <a class="button" href="preview/index.php">Логи</a>
        <a class="button" href="preview/index.php">Просмотр</a>
    </div>
</div>

</body>
</html>
