<?php

session_start();

include "../includes/db.php";

if (isset($_GET['id'])){

$id = $_GET['id'];

$sql = "SELECT book_id FROM borrowings WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();
$borrowing = $result->fetch_assoc();

if (!$borrowing){
    
    die("Borrowing record not found.");
}

$book_id = $borrowing['book_id'];

$sql = "UPDATE borrowings SET status = 'Returned', returned_at = NOW() WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()){

    $sql = "UPDATE books SET available = available + 1 WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $book_id);

    if ($stmt->execute()){
        
        echo "Book returned successfully.";
    }
    else{

        echo "Error updating book: ". $stmt->error;
    }
}
else{

    echo "Error updating borrowing: ". $stmt->error;
}
}
else{

    echo "Borrowing ID not found.";
}
?>