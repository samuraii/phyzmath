<?php

$x = $_SESSION['username'];
$src = "pictures/faces/default/$a.png";

if (1 == $_SESSION['auth']) {
    echo "<a class='button toprofile' href='../cabinet/index.php'>Профиль</a>";
}
