<?php
session_start();

$servername = "db";  
$username = "postgres";
$password = "123";  
$dbname = "library_system";


$conn = pg_connect("host=$servername dbname=$dbname user=$username password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}
?>
