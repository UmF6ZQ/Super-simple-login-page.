<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <script>
        function validateForm() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;

            if (username === "" || password === "") {
                alert("Please enter both username and password.");
                return false;
            }

            if (password.length < 8) {
                alert("Password must be at least 8 characters long.");
                return false;
            }

            if (!/[A-Z]/.test(password) || !/[a-z]/.test(password) || !/\d/.test(password) || !/\W/.test(password)) {
                alert("Password must contain at least one uppercase letter, one lowercase letter, one digit, and one special character.\n");
                return false;
            }

            // If the password meets all conditions, return true
            return true;
        }

    </script>

</head>

<body>
    <div class="container">
        <h2>Login</h2>
        <form onsubmit="return validateForm()" action="login.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <input type="submit" value="Login">
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    </div>
</body>

</html>