
<?php
session_start();

include "../includes/db.php";

$search = $_GET['search'] ?? '';

$sql = "SELECT * FROM books
        WHERE title LIKE ?
        OR author LIKE ?
        OR category LIKE ?";

$stmt = $conn->prepare($sql);

$keyword = "%" . $search . "%";

$stmt->bind_param("sss", $keyword, $keyword, $keyword);

$stmt->execute();

$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Books</title>
</head>
<body>

    <h1>Search Results</h1>

    <p>Search keyword: <?= htmlspecialchars($search) ?></p>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Available</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php if ($result->num_rows > 0): ?>

                <?php while ($book = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $book['id'] ?></td>
                        <td><?= htmlspecialchars($book['title']) ?></td>
                        <td><?= htmlspecialchars($book['author']) ?></td>
                        <td><?= htmlspecialchars($book['category']) ?></td>
                        <td><?= $book['available'] ?></td>
                        <td>
                            <?php if ($book['available'] > 0): ?>
                                <a href="borrow_book.php?id=<?= $book['id'] ?>">
                                    Borrow Book
                                </a>
                            <?php else: ?>
                                Unavailable
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>

            <?php else: ?>

                <tr>
                    <td colspan="6">No books found.</td>
                </tr>

            <?php endif; ?>
        </tbody>
    </table>

    <br>

    <a href="browse_books.php">Back to Browse Books</a>

</body>
</html>
