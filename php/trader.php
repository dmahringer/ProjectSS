<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    $_SESSION['loggedin'] = false;
}
if (!$_SESSION['loggedin']) {
    header('Location: profile.php');
    exit;
}

$host = 'localhost';
$dbname = 'web';
$username = 'web';
$password = 'web';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_SESSION['id'])) {
    echo "User id is not set in the session.";
    exit;
}

// Fetch all the coins that the user owns along with the latest price and the price change in the last 24 hours
$sql = "SELECT coin.id, coin.name, transaction.amount,
        (SELECT price FROM price_history WHERE coin_id = coin.id ORDER BY timestamp DESC LIMIT 1) as price,
        ((SELECT price FROM price_history WHERE coin_id = coin.id ORDER BY timestamp DESC LIMIT 1) -
        (SELECT price FROM price_history WHERE coin_id = coin.id AND timestamp >= DATE_SUB(NOW(), INTERVAL 24 HOUR) ORDER BY timestamp ASC LIMIT 1)) as price_change
        FROM transaction
        JOIN coin ON transaction.coin_id = coin.id
        WHERE transaction.user_id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error: " . $conn->error);
}
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();
$result = $stmt->get_result();
$ownedCoins = $result->fetch_all(MYSQLI_ASSOC);

// Fetch all the coins available for purchase along with the latest price and the price change in the last 24 hours
$sql = "SELECT coin.id, coin.name,
        (SELECT price FROM price_history WHERE coin_id = coin.id ORDER BY timestamp DESC LIMIT 1) as price,
        (((SELECT price FROM price_history WHERE coin_id = coin.id ORDER BY timestamp DESC LIMIT 1) -
        (SELECT price FROM price_history WHERE coin_id = coin.id AND timestamp >= DATE_SUB(NOW(), INTERVAL 24 HOUR) ORDER BY timestamp ASC LIMIT 1)) /
        (SELECT price FROM price_history WHERE coin_id = coin.id AND timestamp >= DATE_SUB(NOW(), INTERVAL 24 HOUR) ORDER BY timestamp ASC LIMIT 1) * 100) as price_change
        FROM coin";
$result = $conn->query($sql);
$availableCoins = $result->fetch_all(MYSQLI_ASSOC);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>Trader</title>
</head>
<header>
    <img src="../img/logo.png">

    <div class="search">
        <input type="text" id="search" name="search" placeholder="Search fro Users, Cryptos, etc.">
    </div>

    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="trader.php" class="active">Trader</a>
        <a href="about.php">About</a>
        <a href="profile.php" class="profile-link">
            <?php if (isset($_SESSION['username'])) echo $_SESSION['username'];
            else echo 'Profile'; ?>
            <img src="../<?php echo isset($_SESSION['profile_pic']) ? $_SESSION['profile_pic'] : 'img/profile-placeholder.jpg'; ?>" class="profile-pic" alt="Profile Picture">
        </a>
    </div>
</header>
<body>
<div class="container trader">
    <h1>Your Coins</h1>
    <ul>
        <?php foreach ($ownedCoins as $coin): ?>
            <li><a href="coin_details.php?id=<?php echo $coin['id']; ?>"><?php echo $coin['name']; ?></a> <span class="amount"><?php echo $coin['amount']; ?></span> <span class="<?php echo $coin['price_change'] >= 0 ? 'positive' : 'negative'; ?>"><?php echo number_format($coin['price_change'], 2); ?>%</span></li>
        <?php endforeach; ?>
    </ul>

    <h1>Available Coins</h1>
    <ul>
        <?php foreach ($availableCoins as $coin): ?>
            <li><a href="coin_details.php?id=<?php echo $coin['id']; ?>"><?php echo $coin['name']; ?></a> <span class="price"><?php echo $coin['price']; ?> $</span> <span class="<?php echo $coin['price_change'] >= 0 ? 'positive' : 'negative'; ?>"><?php echo number_format($coin['price_change'], 2); ?>%</span></li>
        <?php endforeach; ?>
    </ul>
</div>
</body>
</html>