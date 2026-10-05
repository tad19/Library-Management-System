<?php

session_start();

include "../includes/db.php";

//view books
$sql = "SELECT * FROM books";
$books_result = $conn->query($sql);

//view users
$sql = "SELECT * FROM users";
$users_result = $conn->query($sql);

//total books
$sql = "SELECT COUNT(*) AS total_books FROM books";
        $total_books_result = $conn->query($sql);
        $row = $total_books_result->fetch_assoc();
        $total_books = $row['total_books'];

//total available books
$sql = "SELECT SUM(available) AS available_books FROM books";
        $available_books_result = $conn->query($sql);
        $available_books = $available_books_result->fetch_assoc()['available_books'];

//total borrowed books
$sql = "SELECT COUNT(*) AS total_borrowed FROM borrowings";
        $total_borrowed_result = $conn->query($sql);
        $row = $total_borrowed_result->fetch_assoc();
        $total_borrowed = $row['total_borrowed'];

//total users
$sql = "SELECT COUNT(*) AS total_users FROM users";
        $total_users_result = $conn->query($sql);
        $row = $total_users_result->fetch_assoc();
        $total_users = $row['total_users'];

//total overdue books
$sql = "SELECT COUNT(*) AS overdue_books FROM borrowings WHERE due_date < CURDATE() AND status = 'Borrowed'";
        $overdue_result = $conn->query($sql);
        $overdue_books = $overdue_result->fetch_assoc()['overdue_books'];

//view borrowings list
$sql = "SELECT borrowings.id, users.fullname, books.title, borrowings.borrowed_at, borrowings.due_date, borrowings.status
        FROM borrowings JOIN users ON borrowings.user_id = users.id JOIN books ON borrowings.book_id = books.id";
        $borrowing_result = $conn->query($sql);

//view return requests
$sql = "SELECT borrowings.id, users.fullname, books.title, borrowings.borrowed_at, borrowings.due_date, borrowings.return_requested_at
        FROM borrowings JOIN users ON borrowings.user_id = users.id JOIN books ON borrowings.book_id = books.id
        WHERE borrowings.status = 'Return Requested'";
        $return_requests = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/admin_dashboard.css">
</head>

<body>

    <h1 class="h1">WELCOME, <?php echo $_SESSION['fullname']; ?>!</h1>

    <div class="stat-container">
    <aside class="stats">
    <h3 class="h3">Total Books: <?= $total_books ?></h3>
    <h3 class="h3">Available Books: <?= $available_books ?></h3>
    <h3 class="h3">Borrowed Books: <?= $total_borrowed ?></h3>
    <h3 class="h3">Total Users: <?= $total_users ?></h3>
    <h3 class="h3">Overdue Books: <?= $overdue_books ?></h3>
    <a href="../logout.php">
        <button type="button" class="logout-btn" onclick="return confirmLogout()">Logout</button>
    </a>
    </aside>
    </div>

    <br>

<div class="dashboard-tables">
<section class="table-card">
    <div class="book-table-container">
    <h2 class="h2">BOOK TABLE</h2>

    <a href="add_book.php">
    <button type="button" class="add-book">Add Book</button>
    </a>
    </div>
    
    <div class="table-scroll">
        <table>
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

                <?php while($book = $books_result->fetch_assoc()):?>

                    <tr>
                        <td><?= $book['id'] ?></td>
                        <td><?= $book['title'] ?></td>
                        <td><?= $book['author'] ?></td>
                        <td><?= $book['category'] ?></td>
                        <td><?= $book['available'] ?></td>
                        <td>
                            <a href="edit_book.php?id=<?= $book ['id'] ?>">Edit</a>
                            <a href="delete_book.php?id=<?= $book ['id'] ?>" onclick="return confirmDelete()">Delete</a>
                        </td>
                    </tr>

                <?php endwhile;?>

            </tbody>    
        </table>
    </div>
</section>

<section class="table-card">
<h2 class="h2">View Users</h2>
    
    <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Fullname</th>
                    <th>Username</th>
                </tr>
            </thead>
            <tbody>

                <?php while($users = $users_result->fetch_assoc()):?>

                <tr>
                    <td><?= $users['id'] ?></td>
                    <td><?= $users['fullname'] ?></td>
                    <td><?= $users['username'] ?></td>
                </tr>

                <?php endwhile?>
            </tbody>
        </table>
    </div>
</section>
</div>

<br>

<div class="dashboard-tables">
<section class="table-card">
        <h2>View Borrowing List</h2>
    
    <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Book</th>
                    <th>Borrowed</th>
                    <th>Duedate</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>

                <?php while($borrowing = $borrowing_result->fetch_assoc()):?>
                    <tr>
                        <td><?= htmlspecialchars($borrowing['fullname']) ?></td>
                        <td><?= htmlspecialchars($borrowing['title']) ?></td>
                        <td><?= $borrowing  ['borrowed_at'] ?></td>
                        <td><?= $borrowing['due_date'] ?></td>
                        <td><?= $borrowing['status'] ?></td>
                    </tr>
            
                <?php endwhile?>
            </tbody>
        </table>
    </div>
</section>

<section class="table-card">
    <h2>Return Requests</h2>

    <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th>User</th>
                    <th>Book</th>
                    <th>Borrowed Date</th>
                    <th>Due Date</th>
                    <th>Return Requested at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            
                <?php while($request = $return_requests->fetch_assoc()):?>
                    <tr>
                        <td><?= $request['fullname'] ?></td>
                        <td><?= $request['title'] ?></td>
                        <td><?= $request['borrowed_at'] ?></td>
                        <td><?= $request['due_date'] ?></td>
                        <td><?= $request['return_requested_at'] ?></td>
                        <td>
                            <a href="confirm_return.php?id=<?= $request['id'] ?>">Confirm</a>
                        </td>
                    </tr>
                <?php endwhile?>
            </tbody>
        </table>
    </div>
</section>
</div>
    
    <script src="../js/admin.js"></script>

</body>
</html>