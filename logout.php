<?php
// Стартуем сессию
session_start();

// Уничтожаем сессию, чтобы выйти
session_unset();
session_destroy();

// Перенаправляем на страницу входа
header("Location: login.php");
exit;
?>
