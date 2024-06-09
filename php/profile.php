<?php
session_start();

if (!isset($_SESSION['loggedin'])) {
    $_SESSION['loggedin'] = false;
}

if ($_SESSION['loggedin']) {
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        // unset the message after displaying it
        unset($_SESSION['message']);
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css">
        <script src="../js/script.js" defer></script>
        <title>Profile</title>
    </head>
    <header>
        <img src="../img/logo.png">

        <div class="search">
            <input type="text" id="search" name="search" placeholder="Search fro Users, Cryptos, etc.">
        </div>

        <div class="navbar">
            <a href="home.php">Home</a>
            <a href="trader.php">Trader</a>
            <a href="about.php">About</a>
            <a href="profile.php" class="profile-link active">
                <?php if (isset($_SESSION['username'])) echo $_SESSION['username'];
                else echo 'Profile'; ?>
<!--                Profile-->
                <img src="../<?php echo isset($_SESSION['profile_pic']) ? $_SESSION['profile_pic'] : 'img/profile-placeholder.jpg'; ?>" class="profile-pic" alt="Profile Picture">            </a>
        </div>
    </header>
    <body>
        <div class="container">
            <img src="../<?php echo isset($_SESSION['profile_pic']) ? $_SESSION['profile_pic'] : 'img/profile-placeholder.jpg'; ?>" class="profile-pic profile-pic-big" alt="Profile Picture">            <h2 id="username" contenteditable="false"> <?php echo $_SESSION['username']; ?> </h2>
            <p id="change-username" style="cursor: pointer; color: blue;">Change Username</p>
            <br>
            <form action="logout.php" method="post">
                <input type="submit" value="Logout" class="button logout">
            </form>
        </div>
    </body>
    </html>
    <?php

} else {
    $_SESSION['loggedin'] = false;
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../css/style.css">
        <title>Profile</title>
    </head>
    <header>
        <img src="../img/logo.png">

        <div class="search">
            <input type="text" id="search" name="search" placeholder="Search fro Users, Cryptos, etc.">
        </div>

        <div class="navbar">
            <a href="home.php">Home</a>
            <a href="trader.php">Trader</a>
            <a href="about.php">About</a>
            <a href="profile.php" class="profile-link active">
                Profile
                <img src="../img/profile-placeholder.jpg" class="profile-pic" alt="Profile Picture">
            </a>
        </div>
    </header>
    <body>
    <!--    <h1>Login</h1>-->
    <form action="login.php" method="post" class="form-container">
        <input type="text" name="username" placeholder="Username" required class="no-magnifying-glass">
        <input type="password" name="password" placeholder="Password" required class="no-magnifying-glass">
        <input type="submit" value="Login">
    </form>
<!--    <h1>Register</h1>-->
    <form action="register.php" method="post" class="form-container" enctype="multipart/form-data">
        <input type="text" name="username" placeholder="Username" required class="no-magnifying-glass">
        <input type="password" name="password" placeholder="Password" required class="no-magnifying-glass">
        <input type="date" name="dob" placeholder="Date of Birth" required class="no-magnifying-glass">
        <input type="file" name="profile_pic" accept="image/jpeg image/png">
        <input type="submit" value="Register">
    </form>
    </body>
    </html>

    <?php
}
?>