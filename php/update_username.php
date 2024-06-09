<?php
session_start();

// Database connection
$host = 'localhost';
$dbname = 'web';
$username = 'web';
$password = 'web';
$charset = 'utf8mb4';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the new username from the AJAX request
$newUsername = $_POST['username'];
if (str_contains($newUsername, ' ')) {
    echo json_encode([
        'success' => false,
        'error' => 'The username cannot contain spaces',
        'originalUsername' => $_SESSION['username'],
    ]);
    exit;
}

// Check if the username already exists in the database
$stmt = $conn->prepare('SELECT * FROM user WHERE username = ?');
$stmt->bind_param('s', $newUsername);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // The username already exists
    echo json_encode([
        'success' => false,
        'error' => 'The username is already taken',
        'originalUsername' => $_SESSION['username'],
    ]);
} else {
    // The username does not exist, so update it in the database
    $stmt = $conn->prepare('UPDATE user SET username = ? WHERE username = ?');
    $stmt->bind_param('ss', $newUsername, $_SESSION['username']);
    $stmt->execute();

    // Update the username in the session
    $_SESSION['username'] = $newUsername;

    echo json_encode([
        'success' => true,
    ]);
}
?>