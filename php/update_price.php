<?php

$host = 'localhost';
$dbname = 'web';
$username = 'web';
$password = 'web';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if price and id are set in the request body
if (!isset($_POST['price']) || !isset($_POST['id'])) {
    error_log("No price or id in the request");
    exit();
}

$price = $_POST['price'];
$id = $_POST['id'];

// Log the received price
error_log("Received price: " . $price . " for coin id: " . $id);

$sql = "INSERT INTO price_history (coin_id, timestamp, price) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iss", $id, $timestamp, $price);

$timestamp = date('Y-m-d H:i:s'); // Use the current time

if ($stmt->execute()) {
    echo "Record inserted successfully";
} else {
    echo "Error inserting record: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>