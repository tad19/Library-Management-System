<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>

    <h1>Login</h1>

    <form id="loginForm" action="login_process.php" method="POST" onsubmit="Loginbtn(event)">

    <p>Username:
        <input type="text" name="username" id="usernameInput" placeholder="Username">
    </p>

    <p>Password:
        <input type="password" name="password" id="passwordInput" placeholder="Password">
    </p>

        <br>

        <p id="loginError"></p>
        
        <button type="submit">Login</button>

    </form>

    <p>No account?</p>
    <a href="register.php">Register</a>
    <script src="../js/login.js"></script>

</body>
</html>