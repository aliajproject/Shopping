<?php

// info users
$my_localhost = 'localhost';
$my_user = 'root';
$my_password = 'root';
$my_databases = 'categorys';
$my_port = 3306;

// $my_localhost, $my_user, $my_password, $my_databases, $my_port

$conn = mysqli_connect($my_localhost, $my_user, $my_password, $my_databases, $my_port);

if (!$conn) {
    echo "XETA: MySQL-ə qoşulmaq alınmadı !" . mysqli_connect_error();
}

?>