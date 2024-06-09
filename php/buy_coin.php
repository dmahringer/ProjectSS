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
if ($stmt === false) {
    die("Error: " . $conn->error);
}
$stmt->bind_param("i", $_POST['coin_id']);
$stmt->execute();
$result = $stmt->get_result();
$coin = $result->fetch_assoc();

if ($coin['price'] === null) {
    echo "Error: Price for coin id " . $_POST['coin_id'] . " is null.";
    exit;
}

echo "Price for coin id " . $_POST['coin_id'] . " is " . $coin['price'];
echo "<br>";

// Fetch the user id from the database
$sql = "SELECT id FROM user WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Insert a new transaction into the database
$sql = "INSERT INTO transaction (user_id, coin_id, amount, date_purchased, price) VALUES (?, ?, ?, NOW(), ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("iiid", $user['id'], $_POST['coin_id'], $_POST['amount'], $coin['price']);

if ($stmt->execute()) {
    echo "New record created successfully";
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();

// Redirect back to the trader page
header("Location: trader.php");
?>