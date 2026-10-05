<?php

session_start();

include "../includes/db.php";

if (isset($_GET['id'])){

    $book_id = $_GET['id'];

}
else{

    die("Book ID not found.");
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM books WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $book_id);
$stmt->execute();

$result = $stmt->get_result();
$book = $result->fetch_assoc();

if(!$book){

    die("book not found.");
}

if($book['available'] <= 0){

    die("The book is currently unavailable.");

}

$sql = "INSERT INTO borrowings (user_id, book_id, borrowed_at, due_date, status)
        VALUES (?, ?, NOW(), DATE_ADD(CURDATE(), INTERVAL 7 DAY), 'Borrowed')";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user_id, $book_id);

if($stmt->execute()){

    $sql = "UPDATE books SET available = available - 1 WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);
    $stmt->execute();

    echo 'Book borrowed Successfully!';
    echo '<br><br>';

    echo '<a href="browse_books.php">';
    echo '<button type="button">Return</button>';
    echo '</a>';
}
else{

    echo "Error: " . $stmt->error;
}

?>