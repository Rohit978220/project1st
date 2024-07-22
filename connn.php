<?php
$servername = "localhost";  
$username = "root";   
$password = "";
$dbname = "rohitdb";


$connn = new mysqli($servername, $username, $password, $dbname);


if ($connn->connect_error) {
    die("Connection failed: " . $connn->connect_error);
}
?>