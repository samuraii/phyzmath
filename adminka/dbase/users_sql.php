<?php

$conn_users = mysqli_connect('','','','');
if ($conn_users->connect_error) {die("Connection to users failed");}
else echo "Connect to users success" . "<br>";

/**
 * Created by PhpStorm.
 * User: chirkov
 * Date: 26.11.16
 * Time: 15:01
 */
