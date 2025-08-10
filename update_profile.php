<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

// Check if logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];

// Database connection
$conn = mysqli_connect("localhost", "root", "", "binarywe_ar");

if (!$conn) {
    $_SESSION['error'] = "Connection Failed: " . mysqli_connect_error();
    header("Location: profile.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $address = $_POST['PRESENT_ADDRESS'] ?? '';
    $linux_distro = strtoupper($_POST['FAVORITE_LINUX_DISTRO'] ?? '');
    $email = $_POST['EMAIL'] ?? '';
    $phone = $_POST['PHONE'] ?? '';

    $validation_failed = false;

    // Validate email
    if (!preg_match('/(.com|.iubat.edu)$/', $email)) {
        $_SESSION['error'] = "Invalid email format. Email must end with .com or iubat.edu";
        $validation_failed = true;
    }

    // Validate phone
    if (!preg_match('/^\+880/', $phone) || strlen($phone) < 14) {
        $_SESSION['error'] = "Invalid phone number. Phone must start with +880 and be at least 14 characters long.";
        $validation_failed = true;
    }

    // Validate favorite linux distro
    $valid_distros = [
        'UBUNTU', 'LINUX MINT', 'ZORIN OS', 'ELEMENTARY OS', 'ARCH LINUX', 'GENTOO',
        'SLACKWARE', 'VOID LINUX', 'PUPPY LINUX', 'BODHI LINUX', 'TINY CORE LINUX',
        'ANTIX', 'KALI LINUX', 'PARROT OS', 'BLACKARCH', 'MANJARO', 'OPENSUSE TUMBLEWEED',
        'DEBIAN', 'FEDORA', 'CENTOS', 'RED HAT', 'POP!_OS', 'SOLUS'
    ];
    if (!in_array($linux_distro, $valid_distros)) {
        $_SESSION['error'] = "Enter a valid Linux distro.";
        $validation_failed = true;
    }

    if (!$validation_failed) {
        $stmt = $conn->prepare("UPDATE BINARYWEAR_USER SET PRESENT_ADDRESS = ?, FAVORITE_LINUX_DISTRO = ?, EMAIL = ?, PHONE = ? WHERE SL = ?");
        $stmt->bind_param("ssssi", $address, $linux_distro, $email, $phone, $userId);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Profile updated successfully!";
        } else {
            $_SESSION['error'] = "Error updating profile: " . $stmt->error;
        }
        $stmt->close();
    }
    mysqli_close($conn);
    header("Location: profile.php");
    exit();
}
?>