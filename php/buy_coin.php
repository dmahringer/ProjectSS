<?php
session_start();

$host = 'localhost';
$dbname = 'web';
$username = 'web';
$password = 'web';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the coin details and latest price from the database
$sql = "SELECT coin.*, price_history.price FROM coin
        LEFT JOIN price_history ON coin.id = price_history.coin_id
        WHERE coin.id = ? ORDER BY price_history.timestamp DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_POST['coin_id']);
$stmt->execute();
$result = $stmt->get_result();
$coin = $result->fetch_assoc();

if ($coin['price'] === null || $coin['price'] == 0) {
    echo "Error: Price for coin id " . $_POST['coin_id'] . " is null or zero.";
    exit;
}

// Fetch the user id from the database
$sql = "SELECT id FROM user WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$amount = (float)$_POST['amount'];
$price = (float)$coin['price'];
$result = $amount / $price;

error_log("Amount: $amount");
error_log("Price: $price");
error_log("Result: $result");

// Insert a new transaction into the database
$sql = "INSERT INTO transaction (user_id, coin_id, amount, date_purchased, price) VALUES (?, ?, ?, NOW(), ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iidd", $user['id'], $_POST['coin_id'], $result, $coin['price']);

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

// Insert the current price into the price_history table
$sql = "INSERT INTO price_history (coin_id, price, timestamp) VALUES (?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("id", $_POST['coin_id'], $coin['price']);

if ($stmt->execute()) {
    echo "Price history updated successfully";
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();

// Redirect back to the trader page
header("Location: trader.php");
?>