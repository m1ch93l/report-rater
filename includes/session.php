<?php

session_start();
include 'includes/database.php';

if (isset($_SESSION['participant'])) {
    $sql = "SELECT * FROM participant WHERE id = :participant";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':participant', $_SESSION['participant']);
    $stmt->execute();
} else {
    header('location: index.php');
    exit();
}
