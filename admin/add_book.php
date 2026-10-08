<?php

session_start();

include "../includes/db.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $title = $_POST['title'];
    $author = $_POST['author'];
    $category = $_POST['category'];
    $available = $_POST['available'];

    $sql = "INSERT INTO books(title, author, category, available) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $title, $author, $category, $available);

    if ($stmt->execute()){

        echo "Added book succesfully!";
    }

    else{

        echo "Error" . $stmt->error;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Book</title>
        <link rel="stylesheet" href="../css/add_book_form.css">
    </head>
    <body>
        <h1>Add Book Form</h1>

        <form method="POST" class="form-container">

            <div class="input-row">
                <label>Title</label>
                <span>:</span>
                <input type="text" name="title">
            </div>

            <div class="input-row">
                <label>Author</label>
                <span>:</span>
                <input type="text" name="author">
            </div>

            <div class="input-row">
                <label>Category</label>
                <span>:</span>
                <input type="text" name="category">
            </div>

            <div class="input-row">
                <label>Available</label>
                <span>:</span>
                <input type="number" name="available">
            </div>

            <div class="button-container">
                <button type="submit">Add Book</button>
                
                <a href="dashboard.php">
                <button type="button">Return</button>
                </a>
            </div>
        
        </form>
    </body>
</html>