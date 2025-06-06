<?php session_start();

// set the online status to 0
require_once 'includes/database.php';
$sql  = "UPDATE participant SET online_status = 0 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$_SESSION['participant']]);

if ($stmt) {
    
    session_destroy();
    session_unset();
    $_SESSION['hide'] = true;
    header('location: index');
}