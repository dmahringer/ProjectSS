<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>About</title>
</head>
<header>
    <img src="../img/logo.png">

    <div class="search">
        <input type="text" id="search" name="search" placeholder="Search for Users, Cryptos, etc.">
    </div>

    <div class="navbar">
        <a href="home.php">Home</a>
        <a href="trader.php">Trader</a>
        <a href="about.php" class="active">About</a>
        <a href="profile.php" class="profile-link">
            <?php if (isset($_SESSION['username'])) echo $_SESSION['username'];
            else echo 'Profile'; ?>
            <img src="../<?php echo isset($_SESSION['profile_pic']) ? $_SESSION['profile_pic'] : 'img/profile-placeholder.jpg'; ?>" class="profile-pic" alt="Profile Picture">
        </a>
    </div>
</header>
<body>
<div class="container about">
    <h1>About</h1>
    <p>Welcome to our cryptocurrency trading platform. Here, you can buy and sell various cryptocurrencies at their current market prices. Our platform provides real-time price updates, allowing you to make informed trading decisions.</p>
    <p>On the Trader page, you can see your current balance and the list of coins you own. Each coin shows the total amount in USD and the price change in the last 24 hours. You can also see a list of all available coins for trading.</p>
    <p>Click on a coin to see more details and to buy or sell that coin. The coin details page shows the current price, the price change in the last 24 hours, and a chart of the price history.</p>
    <p>We hope you enjoy using our platform and find it useful for your cryptocurrency trading needs.</p>
</div>
</body>
</html>