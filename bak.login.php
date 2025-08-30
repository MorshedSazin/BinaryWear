<?php
session_start();

// $host = "localhost";
// $user = "binarywe"; 
// $pass = "Et;e7iE0uO9S:1";
// $db   = "binarywe_ar";

$conn = mysqli_connect("localhost", "root", "", "binarywe_ar");

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

if (!$email || !$password) {
    die("Email and password are required.");
}

$stmt = $conn->prepare("SELECT SL, PASSWORD FROM BINARYWEAR_USER WHERE EMAIL = ?");
if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("s", $email);

if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}

$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();
    $hashed_password = $row['PASSWORD'];

    if (password_verify($password, $hashed_password)) {
        $_SESSION['user_id'] = $row['SL'];
        header("Location: profile.php");
        exit();
    } else {
        echo "Invalid password.";
    }
} else {
    echo "User not registered.";
}

$stmt->close();
$conn->close();
?>