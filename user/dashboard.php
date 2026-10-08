<?php

session_start();

include "../includes/db.php";

//view books
$sql = "SELECT * FROM books";
        $books_result = $conn->query($sql);

//view borrowed books
$sql = "SELECT * FROM borrowings";
        $borrow_result = $conn->query($sql);

//view borrowing history
$sql = "SELECT borrowings.id, books.title, borrowings.borrowed_at, borrowings.returned_at
        FROM borrowings JOIN books ON borrowings.book_id = books.id 
        WHERE borrowings.status = 'Returned'";
        $history_result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../css/user_dashboard.css">
    
</head>
<body>

<h1>WELCOME, <?php echo $_SESSION['fullname']; ?>!</h1>

    <a href="browse_books.php" class="browse-btn">Browse Books</a>
<br>
    <a href="../logout.php" class="logout-btn">logout</a>
<br>

<div class="dashboard-tables">
<section class="table-card">
<div class="table-container">
<h2>Borrowed Books</h2>
</div>

<div class="table-scroll">
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Date Borrowed</th>
            <th>Duedate</th>
            <th>Status</th>
            <th>Action</th>
            <th>Return Requested</th>
        </tr>
    </thead>
    <tbody>

        <?php while($borrowings = $borrow_result->fetch_assoc()):?>
            <tr>
                <td><?= $borrowings['book_id'] ?></td>
                <td><?= $borrowings['borrowed_at'] ?></td>
                <td><?= $borrowings['due_date'] ?></td>
                <td><?= $borrowings['status'] ?></td>
                <td>
                <a href="return_book.php?id=<?=  $borrowings['id']?>">Return Book Request</a>
                </td>

            <td>
                <?php if($borrowings['status']=='Returned'): ?>
                <form action="clear_table.php" method="POST">
                <input type="hidden" name="id" value="<?= $borrowings['id'] ?>">
                    <button type="submit">Clear</button>
                </form>

                <?php elseif($borrowings['status'] == 'Return Requested'): ?>
                    Return Requested
                <?php endif?>
            </td>
            </tr>
        <?php endwhile?>

    </tbody>
</table>
</div>
</section>
<section class="table-card">
<div class="table-container">
<h2>Borrowing History</h2>
</div>

<div class="table-scroll">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Book</th>
                <th>Borrowed Date</th>
                <th>Returned Date</th>
            </tr>
        </thead>
        <tbody>
                    
            <?php while($borrowings = $history_result->fetch_assoc()):?>
                <tr>
                    <td><?= $borrowings['id'] ?></td>
                    <td><?= $borrowings['title'] ?></td>
                    <td><?= $borrowings['borrowed_at'] ?></td>
                    <td><?= $borrowings['returned_at'] ?></td>
                </tr>
            <?php endwhile?>
        </tbody>
    </table>
</div>
</section>
</div>
</body>
</html>