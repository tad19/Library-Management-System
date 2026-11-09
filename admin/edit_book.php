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
    <link rel="stylesheet" href="../css/edit_book.css">

    <title>Edit Book</title>
</head>

<body>

    <h1>Edit Book</h1>

    <form method="POST" class="form-container">

        <input type="hidden" name="id" value="<?= $book['id'] ?>">

        <div class="input-row">
        <label>Title</label>
        <span>:</span>
        <input type="text" name="title" value="<?= $book['title'] ?>" required>
        </div>

        <div class="input-row">
        <label>Author</label>
        <span>:</span> 
        <input type="text" name="author" value="<?= $book['author'] ?>" required>
        </div>

        <div class="input-row">
        <label>Category</label>
        <span>:</span>
        <input type="text" name="category" value="<?= $book['category'] ?>" required>
        </div>

        <div class="input-row">
        <label>Available</label>
        <span>:</span>
        <input type="number" name="available" value="<?= $book['available'] ?>" required>
        </div>

        <div class="button-container">
        <button type="submit">Update Book</button>
        
        <a href="dashboard.php">
            <button type="button">Return</button>
        </a>
        </div>
    </form>

</body>

</html>