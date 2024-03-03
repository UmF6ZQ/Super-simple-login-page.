<?php
$servername = "mysql";
$dbusername = "root";
$dbpassword = "secret";
$dbname = "bt2_login";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];


    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql_check = "SELECT * FROM users WHERE username = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $username);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        $_SESSION['register_message'] = 'User already exists.';
    } else {

        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $sql_insert = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("ss", $username, $password_hash);
        if ($stmt_insert->execute()) {
            $_SESSION['register_message'] = 'Registered successfully.';
        } else {
            $_SESSION['register_message'] = 'Registration failed.';
        }
        $stmt_insert->close();
    }

    $stmt_check->close();
    $conn->close();
    header("Location: register.php");
    exit();
}
?>
