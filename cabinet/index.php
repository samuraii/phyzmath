<?php

session_start();

require __DIR__ . '/../helpers/helper.php';
unset_quest();

unset($_SESSION['correct_a'], $_SESSION['questions'], $_SESSION['result'], $_SESSION['last_answer']);

function listSubfolders($folder, $datafile)
{
    if ($this_folder = opendir($folder)) {
        while ($subfolder = readdir($this_folder)) {
            if ($subfolder != '.' && $subfolder != '..') {
                $open_subfolder = opendir("$folder/$subfolder");
                while (false !== ($subfolder_file = readdir($open_subfolder))) {
                    if ($subfolder_file == $datafile) {
                        $file = file("$folder/$subfolder/$subfolder_file");
                        echo "<button class='button' name='tests' value='$subfolder'>$file[0]</button>";
                    }
                }
            }
        }
        closedir($this_folder);
    }
}

unset($_SESSION['correct_a'], $_SESSION['questions'], $_SESSION['result'], $_SESSION['last_answer']);

//проверка прохождения через стартовую страницу и открытие сессии
if ($_SESSION['auth'] != 1) {
    header('location: ' . __DIR__ . '/index.php');
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

                <form action="index.php" method="post">

                    <?php listSubfolders('../test_data', 'info.txt'); ?>
                    <a class="button" href="../games">Игры</a>

                </form>

                <a class='button quit' href='../helpers/logout.php'>Выйти</a>

            </div>

        </div>

    </div> <!--wrapper-->

    <footer>

    </footer>

    </body>

    </html>

<?php

?>
