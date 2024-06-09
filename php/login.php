<?php

$host = 'localhost';
$dbname = 'web';
$username = 'web';
$password = 'web';

session_start();

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Error: ' . $conn->error);
    }
    $stmt->bind_param("s", $username);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Password is correct, start a new session
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                $_SESSION['profile_pic'] = $user['profile_pic'];
                $_SESSION['id'] = $user['id'];
                header('Location: profile.php');
                exit;
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "No user found with that username.";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

?>