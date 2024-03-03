<?php
session_start();
$servername = "mysql";
$dbusername = "root";
$dbpassword = "secret";
$dbname = "bt2_login";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];


    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if (($result->num_rows > 0) && (password_verify($password, $result->fetch_assoc()["password"]))) {
            $row = $result->fetch_assoc();
            $_SESSION["loggedin"] = true;
            $_SESSION["username"] = $username;
            header("location: welcome.php");
        } else {
            echo "<script type=\"text/javascript\">" .
                "alert('Invalid username or password.');" .
                "window.location = 'index.php';" .
                "</script>";
        }
        $stmt->close();
        $conn->close();
    }
}
?>