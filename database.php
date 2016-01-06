<?php

$connect = mysql_connect('localhost', 'root', "");
$sql = 'CREATE DATABASE IF NOT EXISTS cpd2374project ;';

if (mysql_query($sql, $connect)) {
    /* echo "Database cpd2374project Created Successfully<br>"; */
} else {
    echo "Error Creating Database:" . mysql_error() . "<br>";
}

$databaseselect = mysql_select_db('cpd2374project', $connect);

if (!$databaseselect) {
    die('can\'t use cpd2374project  : ' . mysql_error() . '<br>');
}

$sql = "CREATE TABLE IF NOT EXISTS accounts  (emailaddress VARCHAR(255), firstname VARCHAR(255), lastname VARCHAR(255), password VARCHAR(255), Hint VARCHAR(255), hintAnswer VARCHAR(255))";

if (mysql_query($sql, $connect) === true) {
    /* echo "Table accounts Created successfully<br>"; */
} else {
    echo "Error Creating Table:" . mysql_error() . "<br>";
}

//include 'registration.php';
?>

