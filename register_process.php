<?php

include "includes/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }


    $sql = "SELECT * FROM users WHERE username = ? OR email = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();

    $result = $stmt->get_result();


    if ($result->num_rows > 0) {

        echo "Username or email already exists.";

    } else {

        $hashed_password = password_hash(
            $password,
            PASSWORD_DEFAULT
        );

        $sql = "INSERT INTO users (fullname, username, email, password)
                VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param(
            "ssss",
            $fullname,
            $username,
            $email,
            $hashed_password
        );


        if ($stmt->execute()) {

            echo "Registration successful!";

            echo '<br><br>';
            echo '<a href="login.php">';
            echo '<button type="button">Go to Login</button>';
            echo '</a>';

        } else {

            echo "Registration failed: " . $stmt->error;

        }

    }

}

?>