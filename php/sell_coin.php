<?php
//session_start();
//
//$host = 'localhost';
//$dbname = 'web';
//$username = 'web';
//$password = 'web';
//
//$conn = new mysqli($host, $username, $password, $dbname);
//
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}
//
//// Fetch the coin details and latest price from the database
//$sql = "SELECT coin.*, price_history.price FROM coin
//        LEFT JOIN price_history ON coin.id = price_history.coin_id
//        WHERE coin.id = ? ORDER BY price_history.timestamp DESC LIMIT 1";
//$stmt = $conn->prepare($sql);
//$stmt->bind_param("i", $_POST['coin_id']);
//$stmt->execute();
//$result = $stmt->get_result();
//$coin = $result->fetch_assoc();
//
//// Calculate the amount of coins to be sold
//$amount = (float)$_POST['amount'];
//$price = (float)$coin['price'];
//$amountToSell = $amount / $price;
//
//// Fetch the user's owned coins from the database
//$sql = "SELECT * FROM transaction WHERE user_id = ? AND coin_id = ?";
//$stmt = $conn->prepare($sql);
//$stmt->bind_param("ii", $_SESSION['user_id'], $_POST['coin_id']);
//$stmt->execute();
//$result = $stmt->get_result();
//$transaction = $result->fetch_assoc();
//
//if ($transaction === null) {
//    error_log("No transaction record found for user_id: " . $_SESSION['user_id'] . " and coin_id: " . $_POST['coin_id']);
//    error_log("SQL query: " . $sql);
//    echo "Error: No transaction record found for this user and coin.";
//    exit;
//}
//
//if ($amountToSell > $transaction['amount']) {
//    echo "Error: You do not own enough of this coin.";
//    exit;
//}
//
//// Subtract the sold amount from the user's owned coins
//$sql = "UPDATE transaction SET amount = amount - ? WHERE user_id = ? AND coin_id = ?";
//$stmt = $conn->prepare($sql);
//$stmt->bind_param("dii", $amountToSell, $_SESSION['user_id'], $_POST['coin_id']);
//
//if ($stmt->execute()) {
//    echo "Coin sold successfully";
//} else {
//    echo "Error: " . $stmt->error;
//}
//
//$conn->close();
//
//// Redirect back to the trader page
//header("Location: trader.php");
//?>





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

// Fetch the user id from the database
$sql = "SELECT id FROM user WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $_SESSION['username']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Fetch the coin details and latest price from the database
$sql = "SELECT coin.*, price_history.price FROM coin
        LEFT JOIN price_history ON coin.id = price_history.coin_id
        WHERE coin.id = ? ORDER BY price_history.timestamp DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_POST['coin_id']);
$stmt->execute();
$result = $stmt->get_result();
$coin = $result->fetch_assoc();

// Calculate the amount of coins to be sold
$amount = (float)$_POST['amount'];
$price = (float)$coin['price'];
$amountToSell = $amount / $price;

// Fetch the user's owned coins from the database
$sql = "SELECT * FROM transaction WHERE user_id = ? AND coin_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $user['id'], $_POST['coin_id']);
$stmt->execute();
$result = $stmt->get_result();
$transaction = $result->fetch_assoc();

if ($transaction === null) {
    error_log("No transaction record found for user_id: " . $user['id'] . " and coin_id: " . $_POST['coin_id']);
    error_log("SQL query: " . $sql);
    echo "Error: No transaction record found for this user and coin.";
    exit;
}

if ($amountToSell > $transaction['amount']) {
    echo "Error: You do not own enough of this coin.";
    exit;
}

// Subtract the sold amount from the user's owned coins
$sql = "UPDATE transaction SET amount = amount - ? WHERE user_id = ? AND coin_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("dii", $amountToSell, $user['id'], $_POST['coin_id']);

if ($stmt->execute()) {
    echo "Coin sold successfully";
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();

// Redirect back to the trader page
header("Location: trader.php");
?>