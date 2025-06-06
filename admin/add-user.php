<?php
require_once '../includes/database.php';

if (isset($_POST['add-participant'])) {
    $participant = $_POST['participant'];

    $sql  = "INSERT INTO rating (participant_id) VALUES (:participant)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':participant', $participant);
    $stmt->execute();

}