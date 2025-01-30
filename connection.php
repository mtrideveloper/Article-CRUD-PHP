<?php
$hostname = "localhost";
$hostAcc = "root";
$password = "mysql";
$dbname = "lab6";

$conn = new mysqli($hostname, $hostAcc, $password, $dbname);

if (!$conn) {
    die("Error" . mysqli_connect_error());
}
