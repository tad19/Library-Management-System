<?php

session_start();

include "../includes/db.php";

if(isset($_POST['id'])){

    $id = $_POST['id'];

    $sql = "DELETE FROM borrowings WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if($stmt->execute()){

        echo "Borrowing record cleared successfully.";
    }
    else{

        echo "Error: ". $stmt->error;
    }
}
else{

    echo "Borrowing ID not found.";
}
?>