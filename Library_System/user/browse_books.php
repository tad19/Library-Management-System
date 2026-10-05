<?php

session_start();

include "../includes/db.php";

$sql = "SELECT * FROM books";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Browse Books</title>

    </head>
    <body>

        <form action="search_books.php" method="GET">
            <input type="text" name="search" placeholder="Search books...">
            <button type="submit">Search</button>
        </form>

        <br>
        
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Category</th>
                    <th>Available</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                
                <?php while($book = $result->fetch_assoc()):?>

                    <tr>
                        <td><?= $book['id']  ?></td>
                        <td><?= $book['title'] ?></td>
                        <td><?= $book['author'] ?></td>
                        <td><?= $book['category'] ?></td>
                        <td><?= $book['available'] ?></td>
                        
                        <td>
                            <a href="borrow_book.php?id=<?= $book['id'] ?>">
                            <button type="button">Borrow Book</button>
                            </a>
                        </td>
                    </tr>

                <?php endwhile;?>
            </tbody>
        </table>

        <br><br>

        <a href="dashboard.php">
        <button type="button">Return</button>
        </a>
        
    </body>
</html>