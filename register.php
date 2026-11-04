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

    <form id="registerForm" action="register_process.php" method="POST" class="form-container">

    <div class="input-row">
        <label>Full Name</label>
        <span>:</span>
        <input type="text" name="fullname" placeholder="Full Name" required>
    </div>

    <div class="input-row">
        <label>Username</label>
        <span>:</span>
        <input type="text" name="username" placeholder="Username" required>
    </div>

    <div class="input-row">
        <label>Email</label>
        <span>:</span>
        <input type="text" name="email" placeholder="Email" required>
    </div>
    
    <div class="input-row">
        <label>Password</label>
        <span>:</span>
        <input type="password" name="password" placeholder="Password" required>
    </div>
    
    <div class="input-row">
        <label>Confirm Password</label>
        <span>:</span>
        <input type="password" name="confirm_password" placeholder="Confirm Password" required>
    </div>

    <div class="button-container">
    <button type="submit">Register</button>

    <a href="index.html">
    <button type="button">Return</button>
    </a>
    </div>

    </form>

</body>
</html> 
