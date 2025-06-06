<?php
session_start();
include 'includes/database.php';

// Get the array of ratings from the request
$ratings = $_POST['ratings'];

if ($ratings == null) {
    header('Location: /report-rater');
}

// Update the ratings for each user in the database
foreach ($ratings as $user_id => $user_ratings) {
    // Check if this rater has already rated this participant
    $checkSql = "SELECT COUNT(*) FROM rate WHERE participant_id = :user_id AND rater_id = :rater_id";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bindParam(':user_id', $user_id);
    $checkStmt->bindParam(':rater_id', $_SESSION['participant']);
    $checkStmt->execute();
    $alreadyRated = $checkStmt->fetchColumn();

    // If not already rated, insert the new rating
    if ($alreadyRated == 0) {
        $sql = "INSERT INTO rate (content, organization, presentation, delivery, participant_id, rater_id) VALUES (:content, :organization, :presentation, :delivery, :user_id, :rater_id)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':content', $user_ratings['content']);
        $stmt->bindParam(':organization', $user_ratings['organization']);
        $stmt->bindParam(':presentation', $user_ratings['presentation']);
        $stmt->bindParam(':delivery', $user_ratings['delivery']);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':rater_id', $_SESSION['participant']);
        $stmt->execute();

        echo '<p class="text-center">Thank you for your rating!</p>
        <h1 class="text-center">Happy Coding!</h1>';
        
    } else {
        echo '<p class="text-center">You have already rated this participant.</p>
        <h1 class="text-center">Happy Coding!</h1>';
    }
}

// $_SESSION['hide'] = true;
