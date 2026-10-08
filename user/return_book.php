<?php

session_start();

include "../includes/db.php";

if(!isset($_SESSION['user_id'])){

    die("You must be logged in.");
}

if(isset($_GET['id'])){

    $borrowing_id = $_GET['id'];
}
else{

    die("Borrowing ID not found.");
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT * FROM borrowings WHERE id = ? AND user_id = ? AND status = 'Borrowed'";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $borrowing_id, $user_id);
$stmt->execute();

$result = $stmt->get_result();

if($result->num_rows == 0){
    
    die("Borrowing record not found or Return already requested.");
}

$sql = "UPDATE borrowings SET status = 'Return Requested', return_requested_at = NOW() WHERE id = ? AND user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $borrowing_id, $user_id);

if($stmt->execute()){

echo 'Return request successfully.';
echo '<br><br>';

echo '<a href="dashboard.php">';
echo 'Back to Dashboard';
echo '</a>';

}
else{

echo "Error: ". $stmt->error;
}

?>