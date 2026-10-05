<?php

session_start();

include "../includes/db.php";

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "DELETE FROM books WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {

        echo "Book deleted successfully!<br>";
        echo '<a href="../admin/dashboard.php"><button type="button">Return</button></a>';

    } else {
        
        echo "Error: " . $stmt->error;
    }
}

?>