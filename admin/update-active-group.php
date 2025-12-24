<?php
session_start();
require_once '../includes/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['active_group'])) {
    $id = (int) $_POST['active_group'];

    $conn->exec("UPDATE `groups` SET status = 0");
    $stmt = $conn->prepare("UPDATE `groups` SET status = 1 WHERE id = ?");
    $stmt->execute([$id]);
    
}