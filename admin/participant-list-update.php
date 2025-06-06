<?php

require_once '../includes/database.php';

$sql  = "SELECT rater_id, participant_id, content, organization, presentation, delivery FROM rate ORDER BY participant_id";
$stmt = $conn->prepare($sql);
$stmt->execute(); 
$ratings = $stmt->fetchAll();

$sql2 = "SELECT id, fullname FROM participant WHERE id NOT IN (SELECT DISTINCT rater_id FROM rate)";
$stmt2 = $conn->prepare($sql2);
$stmt2->execute();
$notRated = $stmt2->fetchAll();

if (count($notRated) > 0) {
    echo "Who did not rated<br>";
    foreach ($notRated as $participant) {
        echo $participant['fullname'] . ', ';
    }
    echo "<br>";
}
