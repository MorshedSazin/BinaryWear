<?php
session_start();

// Check if logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];

$host = "localhost";
$user = "root"; 
$pass = "";
$db   = "binarywe_ar";

$conn = mysqli_connect($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Fetch user info
$sql = "SELECT SL, NAME, EMAIL, PHONE, PRESENT_ADDRESS, LAST_EDUCATION, FAVORITE_LINUX_DISTRO 
        FROM BINARYWEAR_USER 
        WHERE SL = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("User not found");
}

$user_data = $result->fetch_assoc();

$conn->close();