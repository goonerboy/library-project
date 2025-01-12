<?php
// Стартуем сессию
session_start();

// Уничтожаем все, чтобы выйти
session_unset();
session_destroy();

// Перенаправляем на страницу входа
header("Location: login.php");
exit;
?>
