<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: order.php");
    exit();
}

$_SESSION['form_data'] = $_POST;

$db   = "binarywe_ar";
$conn = mysqli_connect("localhost", "root", "", $db);

if (!$conn) {
    $_SESSION['error'] = "Connection Failed: " . mysqli_connect_error();
    header("Location: order.php");
    exit();
}

$required_fields = ['name', 'email', 'phone', 'region', 'city', 'zip', 'zone', 'address', 'payment_method'];

foreach ($required_fields as $field) {
    if (empty($_POST[$field])) {
        $_SESSION['error'] = ucfirst($field) . " is required.";
        header("Location: order.php");
        exit();
    }
}

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$region = strtoupper($_POST['region']);
$city = strtoupper($_POST['city']);
$zip = strtoupper($_POST['zip']);
$zone = strtoupper($_POST['zone']);
$address = strtoupper($_POST['address']);
$payment_method = $_POST['payment_method'];
$transection_id = $_POST['transection_id'];
$total_payment = $_POST['total_payment'];
$items_name = $_POST['items_name'];
$payment_date = date('Y-m-d');

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = "Invalid email format.";
    header("Location: order.php");
    exit();
}

if (!preg_match('/^\+880/', $phone) || strlen($phone) < 14) {
    $_SESSION['error'] = "Invalid phone number. Phone must start with +880 and be at least 14 characters long.";
    header("Location: order.php");
    exit();
}

if (!in_array($payment_method, ['cod', 'card', 'bkash'])) {
    $_SESSION['error'] = "Invalid payment method.";
    header("Location: order.php");
    exit();
}

if ($payment_method === 'cod' && empty($transection_id)) {
    $transection_id = 'Cash On Delivery';
}

if ($payment_method !== 'cod' && empty($transection_id)) {
    $_SESSION['error'] = "Transaction ID is required for this payment method.";
    header("Location: order.php");
    exit();
}

// At this point, all validations have passed.
// You can now proceed with inserting the order into the database.

$sql = "INSERT INTO ORDER_TABLE (NAME, EMAIL, PHONE, REGION, CITY, ZIP, ZONE, ADDRESS, PAYMENT_METHOD, PAYMENT_DATE, TRANSACTION_ID, TOTAL_PAYMENT, ITEMS_NAME) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "sssssssssssss", $name, $email, $phone, $region, $city, $zip, $zone, $address, $payment_method, $payment_date, $transection_id, $total_payment, $items_name);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success'] = "Order placed successfully!";
        unset($_SESSION['form_data']); // Clear form data on success
    } else {
        $_SESSION['error'] = "Error: " . mysqli_stmt_error($stmt);
    }

    mysqli_stmt_close($stmt);
} else {
    $_SESSION['error'] = "Error preparing statement: " . mysqli_error($conn);
}

mysqli_close($conn);

header("Location: order.php");
exit();

?>
