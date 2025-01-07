<?php
include('db.php');
session_start(); // Для работы с сессиями

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Проверка данных пользователя
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username; // Старт сессии для пользователя
            header("Location: books.php"); // Перенаправление на страницу с книгами
            exit;  // Останавливаем выполнение скрипта после перенаправления
        } else {
            echo "<p style='color: red;'>Invalid password.</p>"; // Сообщение об ошибке
        }
    } else {
        echo "<p style='color: red;'>User not found.</p>"; // Сообщение, если пользователь не найден
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Login</h1>
    </header>
    <main>
        <form method="POST" action="login.php">
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>

            <input type="submit" value="Login">
        </form>

        <!-- Кнопка возврата на главную -->
        <a class="back-button" href="index.php">Back to Home</a>
    </main>
</body>
</html>
