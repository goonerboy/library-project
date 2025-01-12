<?php
include('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Хешируем пароль
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Подготовленный запрос для предотвращения SQL-инъекций
    $sql_check = "SELECT * FROM users WHERE username=$1";
    $result_check = pg_query_params($conn, $sql_check, array($username));

    if (pg_num_rows($result_check) > 0) {
        echo "User with this name already exists.";
    } else {
        $sql = "INSERT INTO users (username, password) VALUES ($1, $2)";
        if (pg_query_params($conn, $sql, array($username, $hashed_password))) {
            echo "User successfully registered!";
        } else {
            echo "Error: " . pg_last_error($conn);
        }
    }

    pg_close($conn);
}
?>
