<?php
header('Access-Control-Allow-Origin:*');
header('Access-Control-Allow-Header:Content-Type');
header('Access-Control-Allow-Methods:GET, POST, OPTIONS');

$host = "localhost:4306";
$db_user = "root";
$db_pass = null;
$db_name = "test sef";

$mysqli = new mysqli($host, $db_user, $db_pass, $db_name);

if ($mysqli->connect_error) {
    die("" . $mysqli->connect_error);
} else {
 
}
