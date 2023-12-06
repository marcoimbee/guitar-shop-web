<?php
    $host = 'localhost';        //parameters for db connection
    $user = 'root';
    $password = '';
    $db = 'guitar_shop';

    $mysqli = new mysqli($host, $user, $password, $db);

    if ($mysqli->connect_error) die('Connection error(' . $mysqli->connect_errno . ')' . $mysqli->connect_error);
?>