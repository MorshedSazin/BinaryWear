<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['form_data'] = $_POST;
}

// $host = "localhost";
// $user = "binarywe"; 
// $pass = "Et;e7iE0uO9S:1";
$db   = "binarywe_ar";

$conn = mysqli_connect("localhost", "root", "", $db);

if (!$conn) {
    $_SESSION['error'] = "Connection Failed: " . mysqli_connect_error();
    header("Location: signin.php");
    exit();
}

// Check if all required fields are set
if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['phone']) || !isset($_POST['address']) || !isset($_POST['education']) || !isset($_POST['linux-distro']) || !isset($_POST['password'])) {
    $_SESSION['error'] = "All fields are required.";
    header("Location: signin.php");
    exit();
}

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$education = strtoupper($_POST['education']);
$linux_distro = strtoupper($_POST['linux-distro']);
$password = $_POST['password'];

// Validate email
if (!preg_match('/(.com|.edu)$/', $email)) {
    $_SESSION['error'] = "Invalid email format. Email must end with .com or .edu";
    header("Location: signin.php");
    exit();
}

// Validate phone
if (!preg_match('/^\+880/', $phone) || strlen($phone) < 14) {
    $_SESSION['error'] = "Invalid phone number. Phone must start with +880 and be at least 14 characters long.";
    header("Location: signin.php");
    exit();
}
//validate education ('STUDENT','EMPLOYEE')
$valid_education = ['STUDENT', 'EMPLOYEE'];
if (!in_array(strtoupper($education), $valid_education)) {
    $_SESSION['education_error'] = "Enter valid info for education.";
    header("Location: signin.php");
    exit();
}


//FAVORITE LINUX DISTRO
/*
$valid_distros = [
    'UBUNTU', 'MINT', 'ZORIN OS', 'ELEMENTARY OS', 'ARCH', 'GENTOO',
    'SLACKWARE', 'VOID LINUX', 'PUPPY LINUX', 'BODHI LINUX', 'TINY CORE LINUX',
    'ANTIX', 'KALI LINUX', 'PARROT OS', 'BLACKARCH', 'MANJARO', 'OPENSUSE TUMBLEWEED',
    'DEBIAN', 'FEDORA', 'CENTOS', 'RED HAT', 'POP!_OS', 'SOLUS'
];
if (!in_array(strtoupper($linux_distro), $valid_distros)) {
    $_SESSION['linux_distro_error'] = "Enter a valid Linux distro.";
    header("Location: signin.php");
    exit();
}
 */

// Validate password
if (strlen($password) < 10 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[^A-Za-z0-9]/', $password)) {
    $_SESSION['error'] = "Password must be at least 10 characters long and include at least one uppercase letter, one lowercase letter, one number, and one special character.";
    header("Location: signin.php");
    exit();
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Check if email already exists
$stmt = $conn->prepare("SELECT * FROM BINARYWEAR_USER WHERE EMAIL = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $_SESSION['error'] = "This email is already registered. Please use another email.";
    header("Location: signin.php");
    exit();
} else {
    // Insert new record
    $stmt = $conn->prepare("INSERT INTO BINARYWEAR_USER (NAME, EMAIL, PHONE, PRESENT_ADDRESS, LAST_EDUCATION, FAVORITE_LINUX_DISTRO, PASSWORD) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $email, $phone, $address, $education, $linux_distro, $hashed_password);

    if ($stmt->execute()) {
        $_SESSION['success'] = "You're signed up, login now.";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['error'] = "Insert error: " . $stmt->error;
        header("Location: signin.php");
        exit();
    }
}

$stmt->close();
mysqli_close($conn);

?>
