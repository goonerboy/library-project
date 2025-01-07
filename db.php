<?php
$servername = "localhost";
$username = "root"; // по умолчанию XAMPP использует 'root'
$password = ""; // по умолчанию нет пароля
$dbname = "library_system"; // имя базы данных

// Создание подключения
$conn = new mysqli($servername, $username, $password, $dbname);

// Проверка соединения
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
