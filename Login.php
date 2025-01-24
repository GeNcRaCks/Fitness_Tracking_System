<?php
session_start(); 

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "fitness_tracker"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize error message variable
$errorMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Store user information in session
            $_SESSION['userid'] = $row['userid'];
            $_SESSION['username'] = $row['username'];
            header("Location: index.php"); 
            exit();
        } else {
            // Set error message for invalid password
            $_SESSION['errorMessage'] = "Invalid password.";
            header("Location: login_Front.php");
            exit();
        }
    } else {
        $_SESSION['errorMessage'] = "User  not found.";
        header("Location: login_Front.php");
        exit();
    }
}
?>