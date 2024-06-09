<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/style.css">
    <title>Title</title>
</head>
<header>
    <img src="../img/logo.png">

    <div class="search">
            <input type="text" id="search" name="search" placeholder="Search fro Users, Cryptos, etc.">
    </div>

    <div class="navbar">
        <a href="home.php" class="active">Home</a>
        <a href="trader.php">Trader</a>
        <a href="about.php">About</a>
        <a href="profile.php" class="profile-link">
            <?php if (isset($_SESSION['username'])) echo $_SESSION['username'];
            else echo 'Profile'; ?>
            <img src="../<?php echo isset($_SESSION['profile_pic']) ? $_SESSION['profile_pic'] : 'img/profile-placeholder.jpg'; ?>" class="profile-pic" alt="Profile Picture">        </a>
    </div>
</header>
<body>
    <div class="container">
        <h1>Start your trading journey now!</h1>
        <p>nice welcome text with a very useful text, which explains how this site works and is fascinating.</p>
    </div>

    <div class="button-container">
        <a href="trader.php" class="button">Start Trading</a>
        <p>Don't have an Account?</p>
        <a href="profile.php">Register now!</a>
    </div>
</body>
</html>