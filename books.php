<?php
session_start();
include 'db.php';

// Проверка на авторизацию
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Запрос на получение всех книг
$sql = "SELECT id, title, author, year FROM books WHERE title != '' AND author != '' AND year != ''"; // Убираем пустые записи
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Books</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Available Books</h1>
        <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
        <a href="logout.php">Logout</a>
    </header>

    <main>
        <h2>Books in the Library</h2>

        <?php
        if ($result->num_rows > 0) {
            echo '<div class="books-container">';
            // Выводим данные каждой книги
            while ($row = $result->fetch_assoc()) {
                echo "<div class='book-card'>";
                echo "<h3>" . $row["title"] . "</h3>";
                echo "<p><strong>Author:</strong> " . $row["author"] . "</p>";
                echo "<p><strong>Year:</strong> " . $row["year"] . "</p>";
                echo "</div>";
            }
            echo '</div>';
        } else {
            echo "<p>No books found in the library.</p>";
        }
        ?>

        <h3>Add a New Book</h3>
        <form action="books.php" method="POST">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required><br><br>

            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required><br><br>

            <label for="year">Year:</label>
            <input type="number" id="year" name="year" required><br><br>

            <input type="submit" name="submit" value="Add Book">
        </form>

        <?php
        // Обработка добавления книги
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $author = $_POST['author'];
            $year = $_POST['year'];

            // Вставка новой книги в базу данных
            $sql_insert = "INSERT INTO books (title, author, year) VALUES ('$title', '$author', '$year')";

            if ($conn->query($sql_insert) === TRUE) {
                echo "<p>New book added successfully!</p>";
                // Перезагружаем страницу, чтобы увидеть добавленную книгу
                header("Location: books.php");
            } else {
                echo "Error: " . $sql_insert . "<br>" . $conn->error;
            }
        }

        $conn->close();
        ?>
    </main>
</body>
</html>
