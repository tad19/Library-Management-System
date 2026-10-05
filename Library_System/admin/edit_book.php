<?php

session_start();

include "../includes/db.php";

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "SELECT * FROM books WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    $result = $stmt->get_result();
    $book = $result->fetch_assoc();

} else {

    die("Book ID not found.");

}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $available = $_POST['available'];

    $sql = "UPDATE books SET title = ?, author = ?, category = ?, available = ? WHERE id = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("sssii", $title, $author, $category, $available, $id);

    if ($stmt->execute()) {

        echo "Updated Successfully!<br><br>";

    } else {

        echo "Error: " . $stmt->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Book</title>
</head>

<body>

    <h1>Edit Book</h1>

    <form method="POST">

        <input type="hidden" name="id" value="<?= $book['id'] ?>">

        <p>Title:
            <input type="text" name="title" value="<?= $book['title'] ?>" required>
        </p>

        <p>Author: 
            <input type="text" name="author" value="<?= $book['author'] ?>" required>
        </p>

        <p>Category:
            <input type="text" name="category" value="<?= $book['category'] ?>" required>
        </p>

        <p>Available:
            <input type="number" name="available" value="<?= $book['available'] ?>" required>
        </p>

        <button type="submit">Update Book</button>
        
        <a href="dashboard.php"><button type="button">Return</button></a>

    </form>

</body>

</html>