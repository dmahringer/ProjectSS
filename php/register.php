<?php

$host = 'localhost';
$dbname = 'web';
$username = 'web';
$password = 'web';

session_start();

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $dob = $_POST['dob'];

    // Validate date of birth
    $dobDateTime = DateTime::createFromFormat('Y-m-d', $dob);
    if ($dobDateTime === false || array_sum($dobDateTime::getLastErrors())) {
        echo 'Invalid date of birth.';
        exit;
    }

    // Check if 'profile_pic' is set in $_FILES
    if (!isset($_FILES['profile_pic'])) {
        echo 'No file uploaded.';
        exit;
    }

    $allowed_extensions = array('jpg', 'png');
    $file_extension = pathinfo($_FILES['profile_pic']['name'], PATHINFO_EXTENSION);

    if (!in_array($file_extension, $allowed_extensions)) {
        echo 'Invalid file type. Only JPG and PNG files are allowed.';
        exit;
    }

    // Check if file was uploaded without errors
    if ($_FILES['profile_pic']['error'] == 0) {
        // Generate a new file name
        $new_file_name = $username . '_' . time() . '.' . $file_extension;

        // Move the file to the 'uploads' directory
        if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], '../uploads/' . $new_file_name)) {
            // File uploaded successfully
            $profile_pic_path = 'uploads/' . $new_file_name;
        } else {
            echo 'Error uploading file.';
            exit;
        }
    } else {
        // Check if file upload is empty
        if ($_FILES['profile_pic']['error'] == 4) {
            echo 'No file uploaded.';
            exit;
        } else {
            echo 'Error: ' . $_FILES['profile_pic']['error'];
            exit;
        }
    }

    $sql = "INSERT INTO user (username, password, date_of_birth, profile_pic) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Error: ' . $conn->error);
    }
    $stmt->bind_param("ssss", $username, $password, $dob, $profile_pic_path);

    if ($stmt->execute()) {
        header('Location: profile.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();

?>