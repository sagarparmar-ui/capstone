<?php
// Database credentials
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'capstone';

// Connect to the database
$connection = new mysqli($host, $username, $password, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}



// Close the connection
// $connection->close();

// $conn = mysqli("localhost","root","","capstone")
//         or die("connection error");
?>