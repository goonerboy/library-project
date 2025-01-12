<?php
session_start();
include 'db.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$sql = "SELECT id, title, author, year FROM books";
$result = pg_query($conn, $sql);
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
        <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        <a href="logout.php">Logout</a>
    </header>

    <main>
        <h2>Books in the Library</h2>
        <?php
        if (pg_num_rows($result) > 0) {
            echo '<div class="books-container">';
            while ($row = pg_fetch_assoc($result)) {
                echo "<div class='book-card'>";
                echo "<h3>" . $row["title"] . "</h3>";
                echo "<p><strong>Author:</strong> " . $row["author"] . "</p>";
                echo "<p><strong>Year:</strong> " . $row["year"] . "</p>";
                echo "</div>";
            }
            echo '</div>';
        } else {
            echo "<p>No books found.</p>";
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
        if (isset($_POST['submit'])) {
            $title = $_POST['title'];
            $author = $_POST['author'];
            $year = $_POST['year'];

            $sql_insert = "INSERT INTO books (title, author, year) VALUES ($1, $2, $3)";
            if (pg_query_params($conn, $sql_insert, array($title, $author, $year))) {
                echo "<p>New book added!</p>";
                header("Location: books.php");
            } else {
                echo "Error: " . pg_last_error($conn);
            }
        }

        pg_close($conn);
        ?>
    </main>
</body>
</html>
