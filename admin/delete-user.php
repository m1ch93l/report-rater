<?php 

require_once '../includes/database.php';

// delete the id from the database, that comes from the url
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM rating WHERE participant_id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}