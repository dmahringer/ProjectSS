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

// Fetch the coin details from the database
$sql = "SELECT * FROM coin WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_GET['id']);
$stmt->execute();
$result = $stmt->get_result();
$coin = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title><?php echo $coin['name']; ?> Details</title>
</head>
<header>
    <img src="../img/logo.png">

    <div class="search">
        <input type="text" id="search" name="search" placeholder="Search for Users, Cryptos, etc.">
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
<div class="form-container detail-form">
    <h1><?php echo $coin['name']; ?></h1>
    <div class="detail-row">
        <p><?php echo $coin['description']; ?></p>

        <div class="trade-container">
            <form action="buy_coin.php" method="post" class="detail-form-container">
                <input type="hidden" name="user_id" value="<?php echo $user['id'] ?>">
                <input type="hidden" name="coin_id" value="<?php echo $coin['id']; ?>">
                <input type="number" name="amount" min="1" placeholder="Amount to buy" class="no-magnifying-glass">
                <input type="submit" value="Buy">
            </form>
        </div>

        <div class="trade-container">
            <form action="sell_coin.php" method="post" class="detail-form-container">
                <input type="hidden" name="user_id" value="<?php echo $user['id'] ?>">
                <input type="hidden" name="coin_id" value="<?php echo $coin['id']; ?>">
                <input type="number" name="amount" min="1" placeholder="Amount to sell" class="no-magnifying-glass">
                <input type="submit" value="Sell">
            </form>

        </div>
    </div>

</body>
</html>