<?php
// db.php
$servername = "localhost";
$username = "root"; // Change this to your MySQL username
$password = "";     // Change this to your MySQL password
$dbname = "my_blog";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
