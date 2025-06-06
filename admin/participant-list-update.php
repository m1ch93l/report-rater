<?php

require_once '../includes/database.php';

$sql  = "SELECT rater_id, participant_id, content, organization, presentation, delivery FROM rate ORDER BY participant_id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$ratings = $stmt->fetchAll();

$sql2  = "SELECT id, fullname, online_status FROM participant WHERE id NOT IN (SELECT DISTINCT rater_id FROM rate)";
$stmt2 = $conn->prepare($sql2);
$stmt2->execute();
$notRated = $stmt2->fetchAll();

if (count($notRated) > 0) {
    echo "Who hasn't been rated yet:";

    foreach ($notRated as $participant) {
        if ($participant['online_status'] == 1) {
            echo '<p class="text-capitalize text-success"><i class="bi bi-circle-fill text-success"></i> ' . $participant['fullname'] . '</p>';
        } else {
            echo '<p class="text-capitalize text-danger"><i class="bi bi-circle-fill text-danger"></i> ' . $participant['fullname'] . '</p>';
        }
    }
}
