<?php
header('Content-Type: application/json');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db   = "binarywe_ar";
$conn = mysqli_connect("localhost", "root", "", $db);

if (!$conn) {
    echo json_encode(['error' => 'Connection Failed: ' . mysqli_connect_error()]);
    exit();
}

$sql = "SELECT * FROM ORDER_TABLE";

if (isset($_GET['date']) && !empty($_GET['date'])) {
    $sql .= " WHERE PAYMENT_DATE = ?";
}

$sql .= " ORDER BY PAYMENT_DATE DESC";

if ($stmt = mysqli_prepare($conn, $sql)) {
    if (isset($_GET['date']) && !empty($_GET['date'])) {
        mysqli_stmt_bind_param($stmt, "s", $_GET['date']);
    }

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $orders = mysqli_fetch_all($result, MYSQLI_ASSOC);
        echo json_encode($orders);
    } else {
        echo json_encode(['error' => 'Error executing statement: ' . mysqli_stmt_error($stmt)]);
    }

    mysqli_stmt_close($stmt);
} else {
    echo json_encode(['error' => 'Error preparing statement: ' . mysqli_error($conn)]);
}

mysqli_close($conn);
?>