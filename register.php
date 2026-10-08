<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Registration</title>
    <link rel="stylesheet" href="css/register.css">
</head>

<body>
    <h1>Register Form</h1>
    <form id="registerForm" action="register_process.php" method="POST">

    <p>FullName:
        <input type="text" name="fullname" placeholder="Fullname" required>
    </p>
    <p>Username:
        <input type="text" name="username" placeholder="Username" required>
    </p>
    <p>Email:
        <input type="email" name="email" placeholder="Email" required>
    </p>
    <p>Password:
        <input type="password" name="password" placeholder="Password" required>
    </p>
    <p>Confirm Password:
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
    </p>
    
    <br>

    <button type="submit">Register</button>

    </form>

</body>
</html> 
