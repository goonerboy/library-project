<?php
session_start();

$servername = "db";  // имя контейнера PostgreSQL в сети Docker
$username = "postgres";
$password = "123";  
$dbname = "library_system";

// Подключение к базе данных PostgreSQL
$conn = pg_connect("host=$servername dbname=$dbname user=$username password=$password");

if (!$conn) {
    die("Connection failed: " . pg_last_error());
}
?>
